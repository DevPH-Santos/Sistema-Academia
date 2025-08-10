document.getElementById('treinoForm').addEventListener('submit', function (event) {
    event.preventDefault();

    const objetivo = document.getElementById('objetivo_treino').value
    const musculo = document.getElementById('musculo_treino').value
    const nivel = document.getElementById('nivel_treino').value
    const dias = document.getElementById('dias_treino').value
    const qtd_exercicios_treino = document.getElementById('qtd_exercicios_treino').value
    const result_treino = document.getElementById('result_treino')
    const treinos_dia = document.getElementById('treinos_dia')

    const exercicios = {
        corpo_inteiro: [
            "Agachamento com barra",
            "Levantamento terra (deadlift)",
            "Supino reto com barra",
            "Remada curvada com barra ou halteres",
            "Desenvolvimento militar com halteres",
            "Puxada na polia (pull-down)",
            "Agachamento frontal com barra",
            "Levantamento terra romeno (Romanian deadlift)",
            "Supino inclinado com barra ou halteres",
            "Remada unilateral com halteres",
            "Desenvolvimento Arnold com halteres",
            "Kettlebell swing",
            "Burpee",
            "Thruster (agachamento com desenvolvimento)",
            "Box jump",
            "Battle ropes",

            // +26 novos:
            "Snatch com barra ou halteres",
            "Deadlift high pull com barra ou kettlebell",
            "Man maker com halteres",
            "Tire flip (virada de pneu)",
            "Turkish get-up com kettlebell",
            "Agachamento com salto (jump squat)",
            "Pistol squat (agachamento unilateral)",
            "Flexão de braço com apoio explosivo (clapping push-up)",
            "Walking lunge com halteres",
            "Bear crawl (deslocamento de urso)",
            "Farmer's walk (caminhada com halteres ou kettlebell)",
            "Sled push (empurrada de trenó)",
            "Sprint em subida ou resistência",
            "Pull-up com pegada supinada",
            "Push press com barra ou halteres",
            "Wall ball (arremesso de bola contra parede)",
            "Sandbag clean and press",
            "Overhead squat (agachamento com barra acima da cabeça)",
            "Zercher squat (agachamento com barra nos braços)",
            "Globet squat com kettlebell",
            "Devil's press com halteres",
            "Mountain climbers",
            "Skater jumps (saltos laterais)",
            "Jumping lunges (avanço com salto)",
            "Plank to push-up (prancha para flexão)",
            "Rope climb (subida de corda)"
        ],

        abdomen: [
            "Abdominal tradicional (crunch)",
            "Prancha (plank)",
            "Elevação de pernas deitado",
            "Abdominal bicicleta",
            "Prancha lateral",
            "Abdominal com rotação de tronco (sentado ou com bola suíça)",
            "Abdominal com os pés elevados",
            "Prancha com elevação de pernas",
            "Abdominal com bola suíça",
            "Prancha com toque no ombro",
            "V-ups",
            "Abdominal com corda na polia",
            "Mountain climbers",
            "Abdominal em pé com halteres",
            "Prancha com rotação de quadril",
            "Abdominal com bola medicinal",
            "Hanging leg raises",

            // +21 novos:
            "Russian twist com ou sem peso",
            "Abdominal infra no banco declinado",
            "Sit-up (abdominal completo)",
            "Jackknife (canivete)",
            "Plank walkout (prancha andando)",
            "Dragon flag",
            "Toes to bar (pés até a barra)",
            "Reverse crunch (abdominal reverso)",
            "Side plank com elevação de quadril",
            "Plank jacks (abertura e fechamento de pernas na prancha)",
            "Ab rollout com roda ou barra",
            "L-sit na barra paralela",
            "Flutter kicks (chutes alternados)",
            "Side bends com halteres",
            "Standing cable crunch (abdominal na polia em pé)",
            "Dead bug",
            "Windshield wipers (limpa para-brisas)",
            "Plank shoulder taps",
            "Sit-up com bola medicinal",
            "Hollow body hold",
            "Bird-dog"
        ],

        braco: [
            "Rosca direta com barra ou halteres",
            "Rosca martelo com halteres",
            "Tríceps na polia (ou pulley) com barra ou corda",
            "Tríceps testa com barra ou halteres (deitado no banco)",
            "Mergulho entre bancos (bench dips)",
            "Rosca inversa com barra",
            "Flexão de punho com barra ou halteres (para antebraço)",
            "Rosca concentrada com halteres",
            "Tríceps francês com halteres",
            "Rosca Scott com barra",
            "Tríceps na barra paralela",
            "Flexão de braço (push-up)",
            "Extensão de tríceps acima da cabeça com halteres",
            "Rosca de punho invertida com barra",
            "Tríceps kickback com halteres",
            "Rosca Zottman com halteres",
            "Flexão de braço com pegada fechada (diamond push-up)",

            // +30 novos:
            "Rosca 21 com barra ou halteres",
            "Curl spider (rosca aranha) com halteres ou barra",
            "Curl incline (rosca inclinada) no banco inclinado",
            "Rosca alternada com supinação",
            "Curl drag (rosca arrastada) com barra",
            "Tríceps na testa com barra W",
            "Tríceps unilateral com halter (em pé ou sentado)",
            "Tríceps na polia alta com pegada inversa",
            "Tríceps coice com polia baixa",
            "Tríceps banco (bench triceps press)",
            "Flexão de braço na barra fixa (chin-up)",
            "Barbell cheat curl (rosca roubada)",
            "Curl de concentração na polia baixa",
            "Rosca simultânea com halteres",
            "Rosca alternada com corda na polia",
            "Curl de bíceps no crossover",
            "Rosca inclinada no banco Scott",
            "Flexão de punho inversa com halteres",
            "Levantamento de barra para antebraço (wrist roller)",
            "Prancha com extensão de tríceps (plank triceps extension)",
            "Flexão de braço explosiva (plyo push-up)",
            "Curl com kettlebell",
            "Curl com banda elástica",
            "Extensão de tríceps com banda elástica",
            "Curl cruzado (cross-body hammer curl)",
            "Flexão de braço declinada",
            "Flexão de braço inclinada",
            "Tríceps na máquina (triceps press machine)",
            "Curl no cabo com barra EZ",
            "Curl de concentração na polia alta"
        ],

        perna: [
            "Agachamento com barra",
            "Leg Press (se tiver na academia)",
            "Cadeira extensora",
            "Mesa flexora (leg curl)",
            "Afundo (avanço) com halteres ou barra",
            "Stiff com barra ou halteres",
            "Elevação de panturrilha em pé (calf raise)",
            "Agachamento sumô com halteres ou barra",
            "Cadeira abdutora",
            "Cadeira adutora",
            "Agachamento búlgaro (Bulgarian split squat)",
            "Pistol squat (agachamento unipodal)",
            "Elevação de panturrilha sentado",
            "Caminhada com halteres (farmer's walk)",
            "Agachamento frontal com barra",
            "Cadeira de glúteos (glute bridge machine)",
            "Levantamento terra romeno (Romanian deadlift)",
            "Agachamento com salto (jump squat)",
            "Caminhada em subida (hill walking)",
            "Flexão de joelhos (knee flexion) com faixa elástica",
            "Agachamento isométrico (wall sit)",
            "Caminhada lateral com faixa elástica (lateral band walk)",
            "Agachamento com uma perna (single-leg squat)",
            "Elevação de quadril (hip thrust)",
            "Cadeira de adução de quadril (hip adduction machine)",
            "Cadeira de abdução de quadril (hip abduction machine)",

            // +15 novos exercícios:
            "Step-up em banco ou caixote com halteres",
            "Peso morto sumô com barra ou halteres",
            "Agachamento Zercher",
            "Good Morning com barra",
            "Deslocamento lateral (lateral lunges)",
            "Agachamento Hack (Hack Squat Machine)",
            "Elevação de panturrilha em leg press",
            "Agachamento profundo (deep squat)",
            "Kettlebell swing",
            "Agachamento Jefferson (Jefferson Squat)",
            "Sprint em subida",
            "Escalador de montanha (mountain climber)",
            "Corrida estacionária com elevação de joelhos (high knees)",
            "Skater jump (salto lateral de patinador)",
            "Frog pump (elevação de quadril com sola dos pés unidas)"
        ]

    }

    const padraoSeriesReps = {
        ganho_massa_muscular: {
            iniciante: { series: 4, repeticoes: 8 },
            intermediario: { series: 5, repeticoes: 6 },
            avancado: { series: 6, repeticoes: 4 }
        },
        resistencia: {
            iniciante: { series: 3, repeticoes: 12 },
            intermediario: { series: 4, repeticoes: 15 },
            avancado: { series: 5, repeticoes: 20 }
        },
        condicionamento: {
            iniciante: { series: 3, repeticoes: 15 },
            intermediario: { series: 4, repeticoes: 12 },
            avancado: { series: 5, repeticoes: 10 }
        }
    }

    if (dias < 1 || dias > 7) {
        alert("ERRO | DIGITE VALORES VÁLIDOS")
        return
    }

    if (exercicios[musculo] && padraoSeriesReps[objetivo][nivel]) {
        const exerciciosSelecionados = exercicios[musculo];
        const exerciciosPorDia = qtd_exercicios_treino;
        const totalExerciciosNecessarios = dias * exerciciosPorDia;

        let poolExercicios = [];
        while (poolExercicios.length < totalExerciciosNecessarios) {
            poolExercicios = poolExercicios.concat(exerciciosSelecionados);
        }

        const exerciciosAleatorios = poolExercicios.sort(() => 0.5 - Math.random()).slice(0, totalExerciciosNecessarios);
        const { series, repeticoes } = padraoSeriesReps[objetivo][nivel];

        // Limpa o conteúdo anterior
        result_treino.innerHTML = '';

        for (let i = 0; i < dias; i++) {
            // Cria uma nova div para cada dia
            const diaDiv = document.createElement('div');
            diaDiv.className = 'treinos_dia'; // Usando classe em vez de ID

            // Adiciona o título do dia
            diaDiv.innerHTML = `<h3>Dia ${i + 1}</h3>`;
            diaDiv.innerHTML += `<ul>`;

            for (let j = 0; j < exerciciosPorDia; j++) {
                const index = i * exerciciosPorDia + j;
                if (index < exerciciosAleatorios.length) {
                    diaDiv.innerHTML += `<li>${exerciciosAleatorios[index]} --> ${series} séries de ${repeticoes} repetições</li>`;
                }
            }

            diaDiv.innerHTML += `</ul>`;

            // Adiciona a nova div ao result_treinoado
            result_treino.appendChild(diaDiv);
        }
    }



})

function gerarPdf() {result_treino
    const result_treino = document.getElementById('result_treino');
    const novaJanela = window.open('', '', 'height=1000,width=1000');

    novaJanela.document.write(`
        <html>
            <head>
                <title>Treino Personalizado</title>
                <style>
                    body { font-family: Arial, sans-serif; display: flex; flex-direction: column; aling-items: center; }

                    .treinos_dia { display: flex; flex-direction: column; align-items: flex-start; justify-content: center; width: 100%; padding: 10px; margin: 15px; background: #f0f4f8; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333; cursor: default; }
                    
                    .treinos_dia h3 { margin-bottom: 5px; font-size: 1.5em; color: #1d3557; }

                    .treinos_dia ul { display: flex; flex-direction: column; gap: 12px; padding-left: 10px; width: 100%; list-style-type: none; }

                    .treinos_dia ul li { font-size: 1.1em; line-height: 1.4; }
                </style>
            </head>
            <body>
                ${result_treino.outerHTML}
            </body>
        </html> 
    `);

    novaJanela.document.close();
    novaJanela.focus();
    novaJanela.print();
    novaJanela.close();
}