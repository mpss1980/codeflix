<?php

namespace Tests\Unit;

use App\Models\Genre;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use PHPUnit\Framework\TestCase;

class GenreTest extends TestCase
{
    public function testFillableField()
    {
        $fillable = ['name', 'is_active'];
        $genre = new Genre();
        $this->assertEquals($fillable, $genre->getFillable());
    }

    public function testIfUseTraits()
    {
        $traits = [SoftDeletes::class, Uuid::class];
        $genreTraits = array_keys(class_uses(Genre::class));
        $this->assertEquals($traits, $genreTraits);
    }

    public function testDatesField()
    {
        $dates = ['deleted_at', 'created_at', 'deleted_at'];
        $genre = new Genre();
        foreach ($dates as $date) {
            $this->assertContains($date, $genre->getDates());
        }
        $this->assertCount(count($dates), $genre->getDates());
    }

    public function testCastsField()
    {
        $casts = ['id' => 'string'];
        $genre = new Genre();
        $this->assertEquals($casts, $genre->getCasts());
    }

    public function testIncrementingFields()
    {
        $genre = new Genre();
        $this->assertFalse($genre->incrementing);
    }
}
