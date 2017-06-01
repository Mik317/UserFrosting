<?php
/**
 * UserFrosting (http://www.userfrosting.com)
 *
 * @link      https://github.com/userfrosting/UserFrosting
 * @copyright Copyright (c) 2013-2016 Alexander Weissman
 * @license   https://github.com/userfrosting/UserFrosting/blob/master/licenses/UserFrosting.md (MIT License)
 */
namespace UserFrosting\Sprinkle\Account\Model\Migrations\v400;

use UserFrosting\System\Bakery\Migrations\UFMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

/**
 * Sessions table migration
 * Version 4.0.0
 *
 * See https://laravel.com/docs/5.4/migrations#tables
 * @extends UFMigration
 * @author Alex Weissman (https://alexanderweissman.com)
 */
class ActivitiesTable extends UFMigration
{
    /**
     * {@inheritDoc}
     */
    public function up()
    {
        if (!$this->schema->hasTable('activities')) {
            $this->schema->create('activities', function (Blueprint $table) {
                $table->increments('id');
                $table->string('ip_address', 45)->nullable();
                $table->integer('user_id')->unsigned();
                $table->string('type', 255)->comment('An identifier used to track the type of activity.');
                $table->timestamp('occurred_at')->nullable();
                $table->text('description')->nullable();

                $table->engine = 'InnoDB';
                $table->collation = 'utf8_unicode_ci';
                $table->charset = 'utf8';
                //$table->foreign('user_id')->references('id')->on('users');
                $table->index('user_id');
            });
        }
    }

    /**
     * {@inheritDoc}
     */
    public function down()
    {
        $this->schema->drop('activities');
    }
}