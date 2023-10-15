<?php

namespace App\Http\Controllers;

use App\Service\FileUploadService;
use App\Models\Group;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class GroupController extends BaseController
{
    public function index(Request $request)
    {
        $group = Group::orderBy('created_at', 'asc');
        if ($request->all() !== []) {
            $group = $group->paginate($request['per_page'], ['*'], 'page', $request['page']);
        } else {
            $group = $group->get();
        }

        return $group;
    }

    public function view(string $id)
    {
        try {
            $group = Group::findOrFail($id);
            return $group;
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
                'logo' => 'required',
                'descript' => 'max:200',
            ]);

            // 驗證失敗
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $group = new Group();
            $group->setRawAttributes($request->all());
            // 文件處理
            if (file_exists($_FILES['logo']['tmp_name'])) {
                $file = new FileUploadService();
                $url = $file->upload($_FILES['logo'], 'logo');
                $group->logo = $url;
            }

            $group->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            // 失敗返回錯誤
            return response()->json(['error' => 'Insertion failed'], 500);
        }

        return response()->json($group);
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
                    Rule::unique('group')->ignore($id),
                ],
                'descript' => 'max:200',
            ]);

            // 驗證失敗
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $group = Group::find($id);
            if ($group === null) {
                return response()->json(['message' => 'Resource not found'], 404);
            }
            // 更新 無logo 移除
            if ($updateData['logo'] === null) {
                unset($updateData['logo']);
            } else {
                // 文件處理
                if (file_exists($_FILES['logo']['tmp_name'])) {
                    $file = new FileUploadService();
                    $url = $file->upload($_FILES['logo'], 'logo');
                    $group->logo = $url;
                }
            }
            $group->setRawAttributes($updateData);
            $group->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            // 失敗返回錯誤
            return response()->json(['error' => 'Insertion failed'], 500);
        }

        return $group;
    }

    /**
     * 刪除團體
     * string $id group uuid
     * return OK
     */
    public function delete(string $id)
    {
        try {
            $idList = explode(',', $id);
            Group::whereIn('id', $idList)->delete();

            return 'OK';
        } catch (ModelNotFoundException $e) {
            // 錯誤返回
            return response()->json(['error' => 'not found'], 404);
        }
    }
}
