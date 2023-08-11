<?php

namespace App\Console\Commands;

use App\Enums\RoleEnum;
use App\Enums\UserEnum;
use App\Helpers\CodeHelper;
use App\Models\User;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Command\Command as CommandAlias;
use Throwable;

class CreateSuperAdminCommand extends Command
{
    protected $signature = 'superadmin:create';

    protected $description = 'Create a superadmin user';

    /**
     * @throws Throwable
     */
    public function handle(): int
    {
        DB::beginTransaction();
        try {
            $name = $this->ask('What is the name of the superadmin?');
            if (empty($name)) {
                $this->error('Name is required');

                return CommandAlias::INVALID;
            }

            $phone = $this->ask('What is the phone of the superadmin?');
            if (empty($phone)) {
                $this->error('phone is required');

                return CommandAlias::INVALID;
            }
            if (strlen($phone) < 8) {
                $this->error('phone is too short. It must be at least 8 characters');

                return CommandAlias::INVALID;
            }

            $username = $this->ask('What is the username of the superadmin?');
            if (empty($username)) {
                $this->error('Username is required');

                return CommandAlias::INVALID;
            }

            $email = $this->ask('What is the email of the superadmin?');
            if (empty($email)) {
                $this->error('Email is required');

                return CommandAlias::INVALID;
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->error('Email is invalid');

                return CommandAlias::INVALID;
            }

            $password = $this->secret('What is the password of the superadmin?');
            if (empty($password)) {
                $this->error('Password is required');

                return CommandAlias::INVALID;
            }
            if (strlen($password) < 8) {
                $this->error('Password is too short. It must be at least 8 characters');

                return CommandAlias::INVALID;
            }

            $checkExistUsername = new User();
            $checkExistUsername = $checkExistUsername->where("username",$username);
            $checkExistUsername = $checkExistUsername->withTrashed();
            $checkExistUsername = $checkExistUsername->first();

            if($checkExistUsername){
                $this->error('Username has been taken');

                return CommandAlias::INVALID;
            }

            $checkExistEmail = new User();
            $checkExistEmail = $checkExistEmail->where("email",$email);
            $checkExistEmail = $checkExistEmail->withTrashed();
            $checkExistEmail = $checkExistEmail->first();

            if($checkExistEmail){
                $this->error('Email has been taken');

                return CommandAlias::INVALID;
            }

            $checkExistPhone = new User();
            $checkExistPhone = $checkExistPhone->where("phone",$phone);
            $checkExistPhone = $checkExistPhone->withTrashed();
            $checkExistPhone = $checkExistPhone->first();

            if($checkExistPhone){
                $this->error('Phone has been taken');

                return CommandAlias::INVALID;
            }

            $this->info('Creating a superadmin user with the following credentials:');
            $this->info("Name: $name");
            $this->info("Email: $email");
            $this->info("Phone: $phone");
            $this->info("Username: $username");

            if ($this->confirm('Do you wish to create the user?')) {
                $this->info('Creating the user...');
                $user = User::create([
                    'username' => $username,
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'password' => Hash::make($password),
                    'email_verified_at' => now(),
                ]);
                $user->assignRole(RoleEnum::SUPERADMIN);
                DB::commit();
                $this->info('Superadmin user created successfully.');
            } else {
                $this->error('Superadmin creation cancelled!');
            }

            return CommandAlias::SUCCESS;
        } catch (Exception $e) {
            DB::rollBack();
            $this->error('Could not create the user.');
            $this->error($e->getMessage());

            return CommandAlias::FAILURE;
        }
    }
}
