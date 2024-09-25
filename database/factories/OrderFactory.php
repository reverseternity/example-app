<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // faker - втроенный в laravel пакет, который генерирует тестовые данные для заполнения БД. Это метод из родительского класса Factory, поэтому
    // мы вызываем его конструкцией $this( обращение к методам этого/родительского класса)-> faker. Внутри него есть куча методов, которые интуитивно понятны.
    public function definition(): array
    {
        return [
//            'title' => 'Запрос',
//            'demand' => $this->faker->sentence(),
//            'date' => $this->faker->date(),
//            'time' => $this->faker->time(),
//            'contact' => 'call'

            // в последних версиях laravel появился новый глобальный метод fake() из класса helpers, к которому можно обращаться из любого места, а не только в контексте фабрик.
            // он упрощает синтаксис:
            'title' => 'Запрос',
            'demand' => fake()->sentence(),
            'date' => fake()->date(),
            'time' => fake()->time(),
            'contact' => 'call'
        ];
    }
}
