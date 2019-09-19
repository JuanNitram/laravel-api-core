<?php

namespace App\Services;

use App\Admin;
use App\Models\AdminsTypes;
use App\Models\Sections;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Boolean;

class AdminsService {

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Admin::with('sections')->get();
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function get(int $id): ?Model
    {
        return Admin::where('id', $id)->with('sections')->first();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function remove(int $id): Boolean
    {
        if($admin = Admin::where('id', $id)->first()){
            return $admin->delete();
        }

        return false;
    }

    /**
     * @param array $data
     * @return array
     */
    public function save(array $data = []): array
    {
        if($parent = Admin::where('email', $data['parent'])->first()){
            if($admin_type = AdminsTypes::where('id', $data['types_id'])->first()){
                $sections_attach = [];
                $sections = Sections::all();

                if($parent->types_id == 1){ // The parent is SuperAdmin, then set all sections to new Admin
                    if($data['types_id'] > 1){
                        foreach($data['sections'] as $data_section){
                            foreach($sections as $section)
                                if($data_section == $section->id)
                                    array_push($sections_attach, $data_section);
                        }
                    } else {
                        foreach($sections as $section)
                            array_push($sections_attach, $section->id);
                    }
                } else { // The parent is not Admin, then set sections based on the sections of the parent
                    if($data['types_id'] == 1){
                        return [
                            'success' => false,
                            'message' => 'Hierarchy not respected.'
                        ];
                    } else{ // A Admin wants to create a admin based on his sections
                        $parent_sections = $parent->sections()->get();
                        if($parent->types_id <= $data['types_id']){
                            foreach($data['sections'] as $section){
                                foreach($parent_sections as $parent_section)
                                    if($section == $parent_section->id)
                                        array_push($sections_attach, $section);
                            }
                        } else {
                            return [
                                'success' => false,
                                'message' => 'Hierarchy not respected .'
                            ];
                        }
                    }

                }

                $data['password'] = Hash::make($data['password']);
                $admin = Admin::create($data);
                $admin->sections()->attach($sections_attach);

                return [
                    'success' => true,
                    'data' => [
                        'admin' => $admin
                    ],
                    'message' => 'Admin register successfully.'
                ];
            }
            return [
                'success' => false,
                'message' => 'Admin type doesnt exists.'
            ];
        }
        return [
            'success' => false,
            'message' => 'Parent admin doesnt exists.'
        ];
    }

    /**
     * @param int   $id
     * @param array $data
     * @return array
     */
    public function update(int $id, array $data = []): array
    {
        if($admin = Admin::where('id', $id)->first()){
            $data['password'] = Hash::make($data['password']);

            $admin->update($data);

            $admin->sections()->detach();
            $admin->sections()->attach($data['sections']);

            return [
                'success' => true,
                'data' => [
                    'admin' => $admin
                ],
                'message' => 'Admin updated successfully.'
            ];
        }

        return [
            'success' => false,
            'message' => 'Admin not found.'
        ];
    }
}
