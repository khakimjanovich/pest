<?php

use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('shows courses overview', function () {
    //Arrange
    Course::factory()->create(['title' => 'Course A', 'description' => 'Description course A', 'released_at' => Carbon::yesterday()]);
    Course::factory()->create(['title' => 'Course B', 'description' => 'Description course B', 'released_at' => Carbon::yesterday()]);
    Course::factory()->create(['title' => 'Course C', 'description' => 'Description course C', 'released_at' => Carbon::yesterday()]);

    //Act & Assert
    get(route('home'))
        ->assertSee([
            'Course A',
            'Description course A',
            'Course B',
            'Description course B',
            'Course C',
            'Description course C',
        ]);

});


it('shows only released courses', function () {
    //Arrange
    Course::factory()->create(['title' => 'Course A', 'released_at' => Carbon::yesterday(),]);
    Course::factory()->create(['title' => 'Course B',]);

    //Act & Assert
    get(route('home'))
        ->assertSee([
            'Course A',
        ])
        ->assertDontSee([
            'Course B'
        ]);

});


it('shows courses by release date', function () {
    //Arrange
    Course::factory()->create(['title' => 'Course A', 'released_at' => Carbon::yesterday(),]);
    Course::factory()->create(['title' => 'Course B', 'released_at' => Carbon::now()]);

    //Act
    get(route('home'))
        ->assertSeeTextInOrder([
            'Course A',
            'Course B',
        ]);
    //Assert
});

