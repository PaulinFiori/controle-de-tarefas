<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <style>
            .titulo {
                border: 1px;
                background-color: #c2c2c2;
                text-align: center;
                width: 100%;
                text-transform: uppercase;
                font-weight: bold;
                margin-bottom: 25px;
            }

            .tabela {
                width: 100%;
            }

            .font-weight-normal {
                font-weight: normal;
            }

            table th {
                text-align: left;
            }

            .page-break {
                page-break-after: always;
            }
        </style>
    </head>

    <body>
        <div class="titulo">
            <h2>Lista de tarefas</h2>
        </div>

        <table border='2' class="tabela">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome da tarefa</th>
                    <th>Data limite da conclusão</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($tarefas as $tarefa)
                    <tr>
                        <th class="font-weight-normal">{{ $tarefa->id }}</th>
                        <th class="font-weight-normal">{{ $tarefa->nome }}</th>
                        <th class="font-weight-normal">{{ $tarefa->data_limite }}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="page-break"></div>

        <div class="titulo">
            <h2>Lista de tarefas</h2>
        </div>
    </body>
</html>