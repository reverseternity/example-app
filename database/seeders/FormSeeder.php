<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    //здесь мы вызываем наши фабрики. принцип немного похож на роуты в laravel - Database Seeder - это web.php, Сидеры - это контроллеры, а фабрики это непосредсвенно вьюхи
    // с видимыми данными. в аргументе к функции factory() можно передать, сколько раз вызовется фабрика и создаст запись. Стоит обратить внимание, что если модели не
    // заюзан класс HasFactory, то с этой таблицей фабрика работать не будет.
    public function run(): void
    {
//        User::factory(3)->create();
//
//        // для того, чтобы у каждого юзера были заказы, нам нужно вызвать экземпляры всех записей Юзеров в БД, перебрать их с помощью цикла foreach. Для каждлого экземпляра
//        // юзера мы вызываем фабрику, с помощью которой создаем запись. Как описано ниже, переназначаем поле типа FK user_id этой фабрики на id-шник каждого юзера.
//        // таким образом получаем по два заказа для каждого юзера.
//        $users = User::all();
//        foreach ($users as $user) {
//            //  в функцию create() есть возможность передать массив, который переназначит поля из фабрики. т.к. фабрика в своём return может выдавать только массив,
//            // поля с логикой нужно прописывать здесь.
//            Order::factory(2)->create([
//                'user_id' => $user->id
//            ]);
//        }

        //Сейчас произойдет жуткая магия. Это упрощенная версия всего того, что было написано выше.
        // Если у нас правильно прописаны связи между моделями, то мы можем использовать метод has() в аргумент которого нужно указать вызов экземпляра модели и её фабрики.
        // метод has определит создание экземпляров записи таблицы, которая унаследована он основной.
        // если говорить проще, то для каждой сгенерировноой записи в таблицу users будет принадлежать записи в таблице orders. genius
        User::factory(3)
            ->has(Order::factory(2))
            ->create();

    }
}
