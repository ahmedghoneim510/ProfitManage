<?php

namespace Database\Factories;

use App\Models\Expenditure;
use App\Models\ExpenditureDetail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ExpenditureDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
            $ids= DB::table('expenditures')->pluck('id');
        do {
            $expenditureId = $this->faker->randomElement($ids);
            $month = $this->faker->numberBetween(1, 12);
            $year = '2024';
        } while (ExpenditureDetail::where('expenditure_id', $expenditureId)
            ->where('month', $month)
            ->where('year', $year)
            ->exists());

        return [
            'expenditure_id' =>  $expenditureId,
            'money' => $this->faker->randomNumber(4),
            'month' => $month,
            'year' =>$year,
        ];
    }
}
