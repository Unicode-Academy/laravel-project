<?php

namespace Modules\Students\src\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Modules\Students\src\Models\Student;
use Modules\Students\src\Repositories\StudentsRepositoryInterface;

class StudentsRepository extends BaseRepository implements StudentsRepositoryInterface
{
    public function getModel()
    {
        return Student::class;
    }

    public function getStudents($limit)
    {
        return $this->model->paginate($limit);
    }

    public function getAllStudents()
    {
        return $this->model->select(['id', 'name', 'email', 'status', 'created_at'])->latest();
    }

    public function setPassword($password, $id)
    {
        return $this->update($id, ['password' => Hash::make($password)]);
    }

    public function checkPassword($password, $id)
    {
        $user = $this->find($id);
        if ($user) {
            $hashPassword = $user->password;
            return Hash::check($password, $hashPassword);
        }
        return false;
    }

    public function getCourses($studentId, $filters = [])
    {
        extract($filters);
        $query = $this->find($studentId)->courses();
        if (!empty($teacher_id)) {
            $query->where('teacher_id', $teacher_id);
        }
        if (!empty($keyword)) {
            $query->where(function ($builder) use ($keyword) {
                $builder->where('name', 'like', '%' . $keyword . '%');
                $builder->orWhere('detail', 'like', '%' . $keyword . '%');
            });
        }
        return $query->get();
    }
}
