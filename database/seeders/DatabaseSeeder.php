<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed the Admin User
        $this->seedAdminUser();

        // Seed Roles
        $this->seedRoles();

        // Seed People, Employees, Patients, and other related data
        $this->seedPeopleAndRelations();

        // Seed additional data as needed
        $this->seedAdditionalData();
    }

    /**
     * Seed the Admin User.
     */
    private function seedAdminUser(): void
    {
        $existingUser = DB::table('users')->where('email', 'admin@example.com')->first();

        if (!$existingUser) {
            DB::table('users')->insert([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'), // Change this for production
                'is_admin' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->command->info('Admin user seeded successfully!');
        } else {
            $this->command->warn('Admin user already exists. Skipping user creation.');
        }
    }

    /**
     * Seed Roles.
     */
    private function seedRoles(): void
    {
        $adminUser = DB::table('users')->where('email', 'admin@example.com')->first();

        DB::table('roles')->insert([
            [
                'user_id' => $adminUser->id ?? null,
                'name' => 'Administrator',
                'is_active' => true,
                'note' => 'Default admin role',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $adminUser->id ?? null,
                'name' => 'Manager',
                'is_active' => true,
                'note' => 'Default manager role',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $this->command->info('Roles seeded successfully!');
    }

    /**
     * Seed People, Employees, Patients, and related data.
     */
    private function seedPeopleAndRelations(): void
    {
        // Seed People
        $personId = DB::table('people')->insertGetId([
            'first_name' => 'John',
            'middle_name' => 'A.',
            'last_name' => 'Doe',
            'date_of_birth' => '1980-01-01',
            'is_active' => true,
            'note' => 'Test person',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('People seeded successfully!');

        // Seed Employees
        DB::table('employees')->insert([
            'person_id' => $personId,
            'number' => 'EMP001',
            'employee_type' => 'Doctor',
            'specialization' => 'Dentist',
            'availability' => json_encode(['Monday' => '9:00-17:00', 'Tuesday' => '9:00-17:00']),
            'is_active' => true,
            'note' => 'Test employee',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('Employees seeded successfully!');

        // Seed Patients
        DB::table('patients')->insert([
            'person_id' => $personId,
            'number' => 'PAT001',
            'medical_record' => 'No known allergies',
            'is_active' => true,
            'note' => 'Test patient',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('Patients seeded successfully!');
    }

    /**
     * Seed additional data like appointments, feedback, etc.
     */
    private function seedAdditionalData(): void
    {
        $patient = DB::table('patients')->first();
        $employee = DB::table('employees')->first();

        // Seed Appointments
        DB::table('appointments')->insert([
            'patient_id' => $patient->id,
            'employee_id' => $employee->id,
            'date' => '2024-12-20',
            'time' => '10:00:00',
            'status' => 'Confirmed',
            'is_active' => true,
            'note' => 'Routine checkup',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('Appointments seeded successfully!');

        // Seed Feedback
        DB::table('feedback')->insert([
            'patient_id' => $patient->id,
            'rating' => 5,
            'practice_email' => 'practice@example.com',
            'practice_phone' => '123-456-7890',
            'is_active' => true,
            'note' => 'Excellent service',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('Feedback seeded successfully!');

        // Seed other tables as needed...
    }
}
