<?php

namespace App\Http\Controllers;

use App\Service\FileUploadService;
use App\Models\Member;
use App\Models\MemberRelation;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class MemberController extends BaseController
{
    public function index(Request $request)
    {
        $member = Member::with('MemberRelation.group')->orderBy('created_at', 'asc');
        // 篩選器
        if (isset($request['group'])) {
            $member->whereHas('MemberRelation.group', function ($query) use ($request) {
                $query->whereIn('id', $request['group']);
            });
        }
        if (isset($request['active'])) {
            $member->where('active', $request['active']);
        }
        if (isset($request['name'])) {
            $member->where('name', 'like', "%{$request['name']}%");
        }
        return $member->paginate($request['per_page'], ['*'], 'page', $request['page']);
    }

    public function view(string $id)
    {
        try {
            $member = Member::with('MemberRelation')->findOrFail($id);
            return $member;
        } catch (ModelNotFoundException $e) {
            // 錯誤返回
            return response()->json(['error' => 'not found'], 404);
        }
    }

    public function create(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:group,name',
                'photo' => 'required',
                'birthday' => 'required',
                'color' => 'required',
                'active' => 'required',
                'descript' => 'max:200',
            ]);
            $group = $request->input('group');
            $request = $request->except(['group']);
            // 驗證失敗
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $member = new Member();
            $member->setRawAttributes($request);
            // 文件處理
            if (file_exists($_FILES['photo']['tmp_name'])) {
                $file = new FileUploadService();
                $url = $file->upload($_FILES['photo'], 'liver');
                $member->photo = $url;
            }

            $member->save();

            $memberRelation = new MemberRelation();
            $memberRelation->group_id = $group;
            $memberRelation->liver_id = $member->id;
            $memberRelation->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            // 失敗返回錯誤
            return response()->json(['error' => 'Insertion failed'], 500);
        }

        return response()->json($member);
    }
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
            $updateData = json_decode($request->getContent(), true);
            $validator = Validator::make($updateData, [
                'name' => [
                    'required',
                    'string',
                    Rule::unique('liver')->ignore($id),
                ],
                'birthday' => 'required',
                'color' => 'required',
                'active' => 'required',
                'descript' => 'max:200',
            ]);

            // 驗證失敗
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $member = Member::find($id);
            if ($member === null) {
                return response()->json(['message' => 'Resource not found'], 404);
            }
            // 更新 無photo 移除
            unset($updateData['photo']);
            // 文件處理
            if (file_exists($_FILES['photo']['tmp_name'])) {
                $file = new FileUploadService();
                $url = $file->upload($_FILES['photo'], 'liver');
                $member->photo = $url;
            }

            $member->update($updateData);
            MemberRelation::where('liver_id', $id)->delete();
            $memberRelation = new MemberRelation();
            $memberRelation->group_id = $updateData['group'];
            $memberRelation->liver_id = $id;
            $memberRelation->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            // 失敗返回錯誤
            return response()->json(['error' => $e->getLine() . $e->getMessage()], 500);
        }

        return $member;
    }

    /**
     * 刪除團體
     * string $id member uuid
     * return OK
     */
    public function delete(string $id)
    {
        try {
            $idList = explode(',', $id);
            MemberRelation::whereIn('liver_id', $idList)->delete();
            Member::whereIn('id', $idList)->delete();

            return 'OK';
        } catch (ModelNotFoundException $e) {
            // 錯誤返回
            return response()->json(['error' => 'not found'], 404);
        }
    }
}
