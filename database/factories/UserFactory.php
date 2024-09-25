<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // faker - втроенный в laravel пакет, который генерирует тестовые данные для заполнения БД. Это метод из родительского класса Factory, поэтому
        // мы вызываем его конструкцией $this( обращение к методам этого/родительского класса)-> faker. Внутри него есть куча методов, которые интуитивно понятны.
        return [
//                'name' => $this->faker->name() . ' ' . uniqid(),
//                'phone' => $this->faker->phoneNumber(),
//                'email' => $this->faker->email(),
//                'ip' => $this->faker->ipv4()

            // в последних версиях laravel появился новый глобальный метод fake() из класса helpers, к которому можно обращаться из любого места, а не только в контексте фабрик.
            // он упрощает синтаксис:
            'name' => fake()->name() . ' ' . uniqid(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->email(),
            'ip' => fake()->ipv4()
        ];

    }
}
