<?php
return [
    'install' => function ($app) {
        $util = $app['db']->getUtility();
        if ($util->tableExists('@notes_data') === false) {
            $util->createTable('@notes_data', function ($table) {
                $table->addColumn('id', 'integer', ['unsigned' => true, 'length' => 10, 'autoincrement' => true]);
                $table->addColumn('name', 'string');
				$table->addColumn('content', 'text');
				$table->addColumn('date', 'string');
                $table->setPrimaryKey(['id']);
            });
        }
    },

    'enable' => function ($app) {
    },

    'uninstall' => function ($app) {
        $app['config']->remove('notes');
        $util = $app['db']->getUtility();
        if ($util->tableExists('@notes_data')) {
            $util->dropTable('@notes_data');
        }
    },

    'updates' => [
        '0.0.5' => function ($app) {
        },
    ],
];
