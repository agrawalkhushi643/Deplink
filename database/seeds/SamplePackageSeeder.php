<?php

use App\Models\Package;
use App\Models\User;
use Illuminate\Database\Seeder;

class SamplePackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $package = $this->createPackage(
            $this->getUser('deplink'),
            'sample'
        );
    }

    private function getUser(string $name)
    {
        static $owner = null;
        if (!is_null($owner)) {
            return $owner;
        }

        $owner = User::where('name', $name)->firstOrFail();
        return $owner;
    }

    private function createPackage(User $owner, string $name): Package
    {
        $package = new Package();
        $package->org = $owner->name;
        $package->name = $name;
        $package->owner()->associate($owner);
        $package->saveOrFail();

        return $package;
    }
}
