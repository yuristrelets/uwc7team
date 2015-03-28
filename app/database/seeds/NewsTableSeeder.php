<?php

class NewsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('news')->delete();

        $arrayNews = [
            [
                'title' => 'Первая бесполезная новость по проекту',
                'description' => 'Описание:Первая бесполезная новость по проекту',
                'text' => 'Несмотря на погоду работы по восстановлению Ан-26 "Рятунчик" продолжаются. Полностью готов киль - удалена коррозия, проведена клепка и установка с затяжкой. После регламентных работ установлены на место рули направления, высоты, элероны и, частично, закрылки. Отремонтирована гидросистема - все проверено и работает! Идет сборка и проверка вспомогательной силовой установки (РУ19А-300). На 90% уже заклепан левый бок самолета, справа работы будет поменьше. Уже готовится все необходимое для покраски: закуплены трафареты,  решается вопрос по закупке краски. На подходе обувка для нашей ласточки - держим кулаки!',
                'is_draft' => 0
            ],
            [
                'title' => 'Вторая бесполезная новость по проекту',
                'description' => 'Описание:Вторая бесполезная новость по проекту',
                'text'=> 'Сегодня Ан-26 "Везунчике-Фениксу" залили масло в стойки шасси и закачали азот, выровняли давление и провели проверку.',
                'is_draft' => 0
            ],
            [
                'title' => 'Третья бесполезная новость по проекту',
                'description' => 'Описание:Третья бесполезная новость по проекту',
                'text' => 'Кировоградская авиакомпания "Сирин" (www.airsirin.com) бесплатно машину необходимых для Ан-26 "Везунчик" вещей: лестницы, аэродромный выпрямитель, запчасти к радио и авиаоборудования, тормоза и двигатель.
Фонд "Крылья Феникса" выражает благодарность руководству компании за помощь.',
                'is_draft' => 1
            ],
        ];
        $projects = Project::all();
        foreach ($projects as $project) {
            foreach ($arrayNews as $news) {
                $news['project_id'] = $project->id;
                News::create($news);
            }
        }
    }

}