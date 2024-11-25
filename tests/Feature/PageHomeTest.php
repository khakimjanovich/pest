<?php

use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('shows courses overview', function () {
    //Arrange
    /** @var Course $firstCourse */
    $firstCourse = Course::factory()->released()->create();

    /** @var Course $secondCourse */
    $secondCourse = Course::factory()->released()->create();

    /** @var Course $thirdCourse */
    $thirdCourse = Course::factory()->released()->create();

    //Act & Assert
    get(route('home'))
        ->assertSee([
            $firstCourse->title,
            $firstCourse->description,
            $secondCourse->title,
            $secondCourse->description,
            $thirdCourse->title,
            $thirdCourse->description,
        ]);

});


it('shows only released courses', function () {
    //Arrange
    /** @var Course $firstCourse */
    $firstCourse = Course::factory()->released()->create();

    /** @var Course $secondCourse */
    $secondCourse = Course::factory()->create();

    //Act & Assert
    get(route('home'))
        ->assertSee([
            $firstCourse->title,
        ])
        ->assertDontSee([
            $secondCourse->title
        ]);

});


it('shows courses by release date', function () {
    //Arrange
    /** @var Course $firstCourse */
    $firstCourse = Course::factory()->released(Carbon::yesterday())->create();

    /** @var Course $secondCourse */
    $secondCourse = Course::factory()->released(Carbon::now())->create();

    //Act & Assert
    get(route('home'))
        ->assertSeeTextInOrder([
            $secondCourse->title,
            $firstCourse->title,
        ]);
});

