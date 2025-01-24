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

        // Seed additional data like appointments, feedback, etc.
        $this->seedAdditionalData();
    }

    /**
     * Seed the Admin User.
     */
    private function seedAdminUser(): void
    {
        $existingUser = DB::table('users')->where('email', 'admin@admin.com')->first();

        if (!$existingUser) {
            DB::table('users')->insert([
                'name' => 'Admin User',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'), // Change this for production
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
        $adminUser = DB::table('users')->where('email', 'admin@admin.com')->first();

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

        // Seed Contacts
        DB::table('contacts')->insert([
            'patient_id' => $patient->id,
            'street_name' => 'Main Street',
            'house_number' => '123',
            'postal_code' => '12345',
            'city' => 'Cityville',
            'mobile' => '1234567890',
            'email' => 'contact@example.com',
            'is_active' => true,
            'note' => 'Primary contact',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('Contacts seeded successfully!');

        // Seed Availabilities
        DB::table('availabilities')->insert([
            'employee_id' => $employee->id,
            'from_date' => '2024-01-01',
            'to_date' => '2024-12-31',
            'from_time' => '09:00:00',
            'to_time' => '17:00:00',
            'status' => 'Present',
            'is_active' => true,
            'note' => 'Standard working hours',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('Availabilities seeded successfully!');

        // Seed Treatments
        DB::table('treatments')->insert([
            'employee_id' => $employee->id,
            'patient_id' => $patient->id,
            'date' => '2024-12-20',
            'time' => '10:00:00',
            'treatment_type' => 'Routine Checkup',
            'description' => 'General checkup with cleaning',
            'cost' => 100.00,
            'status' => 'Treated',
            'is_active' => true,
            'note' => 'No complications',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('Treatments seeded successfully!');

        // Seed Invoices
        DB::table('invoices')->insert([
            'patient_id' => $patient->id,
            'treatment_id' => 1, // Assuming this is the treatment we just inserted
            'number' => 'INV001',
            'date' => '2024-12-20',
            'amount' => 100.00,
            'status' => 'Paid',
            'is_active' => true,
            'note' => 'Payment received in full',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('Invoices seeded successfully!');

        // Seed Communications
        DB::table('communications')->insert([
            'patient_id' => $patient->id,
            'employee_id' => $employee->id,
            'message' => 'Your appointment has been confirmed for 2024-12-20.',
            'sent_date' => '2024-12-19',
            'is_active' => true,
            'note' => 'Appointment reminder',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('Communications seeded successfully!');
    }
}
