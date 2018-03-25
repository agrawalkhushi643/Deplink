<?php

use App\Models\Package;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('org');
            $table->string('name');
            $table->unsignedInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('users');
            $table->unique(['org', 'name']);
            $table->timestamps();
        });

        $this->createPackage(
            $this->getUser('deplink'),
            'sample'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
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
