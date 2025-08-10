/*document.getElementById('dietForm').addEventListener('submit', function (event) {
    event.preventDefault();

    const sexo = document.querySelector('input[name="sexo"]:checked').value;
    const idade = parseInt(document.getElementById('idade').value);
    const peso = parseFloat(document.getElementById('peso').value);
    const altura = parseFloat(document.getElementById('altura').value);
    const nivelAtividade = document.getElementById('nivelAtividade').value;
    const objetivo = document.getElementById('objetivo').value;

    // Calculo da TMB
    let tmb = (sexo === 'Masculino')
        ? 88.362 + (13.397 * peso) + (4.799 * altura) - (5.677 * idade)
        : 447.593 + (9.247 * peso) + (3.098 * altura) - (4.330 * idade);

    // Fator de atividade
    const fatores = {
        "sedentario": 1.2,
        "leve": 1.375,
        "moderado": 1.55,
        "intenso": 1.725,
        "atleta": 1.9
    };
    const gastoCaloricoDiario = tmb * fatores[nivelAtividade];
    const consumoSemanal = gastoCaloricoDiario * 7;

    // Ajuste calórico baseado no objetivo
    let caloriasObjetivo = gastoCaloricoDiario;
    if (objetivo === 'perder') caloriasObjetivo -= 500;
    if (objetivo === 'ganhar') caloriasObjetivo += 500;

    // Estratégias de macros
    const estrategias = {
        "Carboidratos Moderados": [0.30, 0.35, 0.35]
    };

    // Exibição de macros por estratégia
    let macrosHTML = '';
    Object.keys(estrategias).forEach(tipo => {
        let [p, g, c] = estrategias[tipo];
        let proteina = Math.round((caloriasObjetivo * p) / 4);
        let gordura = Math.round((caloriasObjetivo * g) / 9);
        let carboidrato = Math.round((caloriasObjetivo * c) / 4);

        macrosHTML += `
            <div class="box">
                <h4>${tipo}</h4>
                <p>Proteína: <strong>${proteina}g</strong></p>
                <p>Gordura: <strong>${gordura}g</strong></p>
                <p>Carboidratos: <strong>${carboidrato}g</strong></p>
            </div>
        `;
    });

    function imcCalc(peso, altura) {
        var imc = peso / ((altura / 100) * (altura / 100));

        if (imc < 18.5) {
            return { imc: imc, classificacao: "Abaixo do peso" };
        } else if (imc >= 18.5 && imc < 24.9) {
            return { imc: imc, classificacao: "Normal" };
        } else if (imc >= 25 && imc < 29.9) {
            return { imc: imc, classificacao: "Sobrepeso" };
        } else if (imc >= 30 && imc < 34.9) {
            return { imc: imc, classificacao: "Obesidade I" };
        } else if (imc >= 35 && imc < 39.9) {
            return { imc: imc, classificacao: "Obesidade II" };
        } else {
            return { imc: imc, classificacao: "Obesidade III" };
        }
    }

    var resultadoIMC = imcCalc(peso, altura)

    document.getElementById('result').innerHTML = `
        <button onclick="gerarPdf()"><i class='bx bxs-download' ></i></button>
        <p>Sexo: ${sexo}, Idade: ${idade}, Peso: ${peso} kg, Altura: ${(altura)} cm</p>
        <br><p>IMC: ${resultadoIMC.imc.toFixed(2)} (${resultadoIMC.classificacao})</p>
        <br><p>Gasto Calórico Diário: <strong>${Math.round(gastoCaloricoDiario)}</strong> calorias/dia</p>
        <p>Consumo Semanal: <strong>${Math.round(consumoSemanal)}</strong> calorias/semana</p>
        <p>Taxa Metabólica Basal: <strong>${Math.round(tmb)}</strong> calorias/dia</p>
        <br><br><p><strong>Calorias diárias para ${objetivo} peso: ${Math.round(caloriasObjetivo)} kcal</strong></p>
    `;

    document.getElementById('macros').innerHTML = macrosHTML;

    // --- Refeições reais baseadas em alimentos ---
    const alimentos = {
        proteina: [
            "Carne", "Ovos", "Peixe", "Aves", "Leguminosas", "Nozes", "Sementes",
            "Tofu", "Quinoa", "Laticínios", "Feijões", "Iogurte Grego", "Queijo"
        ],
        carboidrato: [
            "Arroz", "Macarrão", "Pão", "Batatas", "Quinoa", "Aveia", "Cereais",
            "Feijões", "Lentilhas", "Batata-doce", "Cevada", "Milheto", "Frutas"
        ],
        gordura: [
            "Abacate", "Azeite", "Óleo de coco", "Peixes gordurosos", "Nozes",
            "Sementes", "Manteigas de nozes", "Chocolate amargo", "Iogurte integral",
            "Queijo", "Ovos", "Azeitonas"
        ]
    };

    function escolherAleatorio(lista) {
        return lista[Math.floor(Math.random() * lista.length)];
    }

    const proporcoes = {
        "Café da Manhã": 0.25,
        "Almoço": 0.4,
        "Jantar": 0.35
    };

    let dietaHTML = '';
    const [p, g, c] = estrategias["Carboidratos Moderados"];

    Object.keys(proporcoes).forEach(refeicao => {
        const calRefeicao = caloriasObjetivo * proporcoes[refeicao];
        const proteina = Math.round((calRefeicao * p) / 4);
        const gordura = Math.round((calRefeicao * g) / 9);
        const carboidrato = Math.round((calRefeicao * c) / 4);

        const alimentoProteina = escolherAleatorio(alimentos.proteina);
        const alimentoGordura = escolherAleatorio(alimentos.gordura);
        const alimentoCarbo = escolherAleatorio(alimentos.carboidrato);

        dietaHTML += `
            <div class="box">
                <h4>${refeicao}</h4>
                <p><strong>${Math.round(calRefeicao)} kcal</strong></p>
                <p>Macros: Proteína: ${proteina}g | Gordura: ${gordura}g | Carboidrato: ${carboidrato}g</p>
                <p>Exemplo: ${alimentoProteina}, ${alimentoCarbo}, ${alimentoGordura}</p>
            </div>

        `;

    });


    // Agora sim: exibe a dieta na div #dieta (e não mais na #macros)
    document.getElementById('dieta').innerHTML = dietaHTML;
    document.getElementById('dieta').innerHTML += `
    
        <table>
            <thead>
                <tr>
                    <th>Fonte de Proteínas</th>
                    <th>Fonte de Carboidratos</th>
                    <th>Fonte de Gorduras</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Carne</td>
                    <td>Arroz (ex: arroz branco, arroz integral)</td>
                    <td>Abacate</td>
                </tr>
                <tr>
                    <td>Ovos</td>
                    <td>Macarrão (ex: espaguete, penne)</td>
                    <td>Azeite</td>
                </tr>
                <tr>
                    <td>Peixe</td>
                    <td>Pão (ex: pão integral, baguete)</td>
                    <td>Óleo de coco</td>
                </tr>
                <tr>
                    <td>Aves</td>
                    <td>Batatas</td>
                    <td>Peixes gordurosos (ex: salmão, cavala)</td>
                </tr>
                <tr>
                    <td>Leguminosas (ex: lentilhas, grão-de-bico)</td>
                    <td>Quinoa</td>
                    <td>Nozes (ex: amêndoas, nozes)</td>
                </tr>
                <tr>
                    <td>Nozes (ex: amêndoas, amendoins)</td>
                    <td>Aveia</td>
                    <td>Sementes (ex: sementes de chia, linhaça)</td>
                </tr>
                <tr>
                    <td>Sementes (ex: sementes de chia, sementes de girassol)</td>
                    <td>Cereais (ex: flocos de milho, aveia)</td>
                    <td>Manteigas de nozes (ex: manteiga de amêndoa, manteiga de amendoim)</td>
                </tr>
                <tr>
                    <td>Tofu</td>
                    <td>Feijões (ex: feijão preto, feijão vermelho)</td>
                    <td>Chocolate amargo (com alto teor de cacau)</td>
                </tr>
                <tr>
                    <td>Quinoa</td>
                    <td>Lentilhas</td>
                    <td>Iogurte integral</td>
                </tr>
                <tr>
                    <td>Laticínios (ex: queijo, iogurte)</td>
                    <td>Batata-doce</td>
                    <td>Queijo (com moderação)</td>
                </tr>
                <tr>
                    <td>Feijões (ex: feijão preto, feijão vermelho)</td>
                    <td>Cevada</td>
                    <td>Ovos (contêm gorduras saudáveis na gema)</td>
                </tr>
                <tr>
                    <td>Iogurte Grego</td>
                    <td>Milheto</td>
                    <td>Azeitonas</td>
                </tr>
                <tr>
                    <td>Queijo</td>
                    <td>Frutas (ex: bananas, maçãs)</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    `

    // Exibir os valores reais por refeição de forma detalhada
    let proteina = Math.round((caloriasObjetivo * p) / 4);
    let gordura = Math.round((caloriasObjetivo * g) / 9);
    let carboidrato = Math.round((caloriasObjetivo * c) / 4);

    let totalKcal = (Math.round(proteina*4) + Math.round(gordura*9) + Math.round(carboidrato*4)) / 3

    let divisaoMacrosHTML = `

        <div class="box">
        
            <h4>Divisão da dieta:</h4>

            Proteina: <strong>${Math.round(proteina/3)}g</strong>
            <br>
            Gordura: <strong>${Math.round(gordura/3)}g</strong>
            <br>
            Carboidrato: <strong>${Math.round(carboidrato/3)}g</strong>
        
        </div>

        <div class="box">
        
            <h4>Total calórico:</h4>

            <strong>${Math.round(totalKcal)}kcal por refeição</strong>
        
        </div>


    `;

    document.getElementById('resultadosMacros').innerHTML = divisaoMacrosHTML;

});

function gerarPdf() {
    const tabela = document.querySelector('#dieta table');
    const dieta = document.getElementById('dieta');
    const result = document.getElementById('result');
    const resultadosMacros = document.getElementById('resultadosMacros');
    const macros = document.getElementById('macros');
    const novaJanela = window.open('', '', 'height=1000,width=1000');

    novaJanela.document.write(`
        <html>
            <head>
                <title>Dieta Personalizada</title>
                <style>
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    .img-container { text-align: center; margin-bottom: 20px; }
                    img { width: 250px; height: 250px;}
                    .box, #result { margin: 20px auto; padding: 20px; width: fit-content; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); background: white; }
                    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                    thead { background: #D32F2F; color: white; }
                    th, td { padding: 5px; text-align: center; border: 1px solid #ddd; }
                    tbody tr:nth-child(even) { background: #f9f9f9; }
                </style>
            </head>
            <body>
                <div class="img-container">
                    <img src="imagens/logo.png">
                </div>
                ${result.outerHTML}
                ${macros.outerHTML}
                ${resultadosMacros.outerHTML}
                ${dieta.outerHTML}
                ${tabela.outerHTML}
            </body>
        </html>
    `);

    novaJanela.document.close();
    novaJanela.focus();
    novaJanela.print();
    novaJanela.close();
}*/

document.getElementById('dietForm').addEventListener('submit', function (event) {
    event.preventDefault();

    // Verificação segura para sexo selecionado
    const sexoSelecionado = document.querySelector('input[name="sexo"]:checked');
    if (!sexoSelecionado) {
        alert("Por favor, selecione o sexo.");
        return;
    }
    const sexo = sexoSelecionado.value;

    const idade = parseInt(document.getElementById('idade').value);
    const peso = parseFloat(document.getElementById('peso').value);
    const altura = parseFloat(document.getElementById('altura').value);
    const nivelAtividade = document.getElementById('nivelAtividade').value.toLowerCase().trim();
    const objetivo = document.getElementById('objetivo').value;

    // Calculo da TMB
    let tmb = (sexo === 'Masculino')
        ? 88.362 + (13.397 * peso) + (4.799 * altura) - (5.677 * idade)
        : 447.593 + (9.247 * peso) + (3.098 * altura) - (4.330 * idade);

    // Fator de atividade
    const fatores = {
        "sedentario": 1.2,
        "leve": 1.375,
        "moderado": 1.55,
        "intenso": 1.725,
        "atleta": 1.9
    };
    const gastoCaloricoDiario = tmb * fatores[nivelAtividade];
    const consumoSemanal = gastoCaloricoDiario * 7;

    // Ajuste calórico baseado no objetivo
    let caloriasObjetivo = gastoCaloricoDiario;
    if (objetivo === 'perder') caloriasObjetivo -= 500;
    if (objetivo === 'ganhar') caloriasObjetivo += 500;

    // Macros
    let proteina, gordura, carboidrato;
    const editarMacros = document.getElementById('editarMacros')?.checked;

    if (editarMacros) {
        proteina = parseInt(document.getElementById('proteinaManual').value);
        gordura = parseInt(document.getElementById('gorduraManual').value);
        carboidrato = parseInt(document.getElementById('carboManual').value);
        caloriasObjetivo = (proteina * 4) + (gordura * 9) + (carboidrato * 4);
    } else {
        proteina = Math.round((caloriasObjetivo * 0.3) / 4);
        gordura = Math.round((caloriasObjetivo * 0.35) / 9);
        carboidrato = Math.round((caloriasObjetivo * 0.35) / 4);
    }

    // Exibir macros
    const macrosHTML = `
        <div class="box">
            <h4>Macros Utilizados</h4>
            <p>Proteína: <strong>${proteina}g</strong></p>
            <p>Gordura: <strong>${gordura}g</strong></p>
            <p>Carboidratos: <strong>${carboidrato}g</strong></p>
        </div>
    `;
    document.getElementById('macros').innerHTML = macrosHTML;

    // Cálculo do IMC
    const imc = peso / ((altura / 100) ** 2);
    let classificacao;
    if (imc < 18.5) classificacao = "Abaixo do peso";
    else if (imc < 24.9) classificacao = "Normal";
    else if (imc < 29.9) classificacao = "Sobrepeso";
    else if (imc < 34.9) classificacao = "Obesidade I";
    else if (imc < 39.9) classificacao = "Obesidade II";
    else classificacao = "Obesidade III";

    document.getElementById('result').innerHTML = `
        <button onclick="gerarPdf()"><i class='bx bxs-download'></i></button>
        <img style="width: 250px; height: 250px; margin: 0 auto;" src="../imagens/logo.png">
        <p>Sexo: ${sexo}, Idade: ${idade}, Peso: ${peso} kg, Altura: ${altura} cm</p>
        <br><p>IMC: ${imc.toFixed(2)} (${classificacao})</p>
        <br><p>Gasto Calórico Diário: <strong>${Math.round(gastoCaloricoDiario)}</strong> kcal/dia</p>
        <p>Consumo Semanal: <strong>${Math.round(consumoSemanal)}</strong> kcal/semana</p>
        <p>Taxa Metabólica Basal: <strong>${Math.round(tmb)}</strong> kcal/dia</p>
        <br><br><p><strong>Calorias diárias para ${objetivo} peso: ${Math.round(caloriasObjetivo)} kcal</strong></p>
    `;

    // Divisão de macros por refeição
    // Divisão de macros por refeição
    const proporcoes = {
        "Café da Manhã": 0.25,
        "Almoço": 0.4,
        "Jantar": 0.35
    };

    const alimentos = {
        "Café da Manhã": {
            proteina: ["Ovos", "Iogurte Grego", "Queijo", "Tofu"],
            carboidrato: ["Pão", "Aveia", "Frutas", "Cereais"],
            gordura: ["Abacate", "Nozes", "Sementes", "Iogurte integral"]
        },
        "Almoço": {
            proteina: ["Carne", "Peixe", "Aves", "Leguminosas"],
            carboidrato: ["Arroz", "Macarrão", "Batatas", "Feijões"],
            gordura: ["Azeite", "Óleo de coco", "Peixes gordurosos"]
        },
        "Jantar": {
            proteina: ["Carne", "Peixe", "Aves", "Leguminosas"],
            carboidrato: ["Quinoa", "Batata-doce", "Cevada"],
            gordura: ["Azeite", "Nozes", "Sementes"]
        }
    };

    function escolherAleatorio(lista) {
        return lista[Math.floor(Math.random() * lista.length)];
    }

    let dietaHTML = '';

    Object.keys(proporcoes).forEach(refeicao => {
        const calRefeicao = caloriasObjetivo * proporcoes[refeicao];
        const prot = Math.round((proteina * proporcoes[refeicao]));
        const gord = Math.round((gordura * proporcoes[refeicao]));
        const carb = Math.round((carboidrato * proporcoes[refeicao]));

        const alimentoProteina = escolherAleatorio(alimentos[refeicao].proteina);
        const alimentoGordura = escolherAleatorio(alimentos[refeicao].gordura);
        const alimentoCarbo = escolherAleatorio(alimentos[refeicao].carboidrato);

        dietaHTML += `
        <div class="box">
            <h4>${refeicao}</h4>
            <p><strong>${Math.round(calRefeicao)} kcal</strong></p>
            <p>Macros: Proteína: ${prot}g | Gordura: ${gord}g | Carboidrato: ${carb}g</p>
            <br><br>
            <p>Exemplo: ${alimentoProteina}, ${alimentoCarbo}, ${alimentoGordura}</p>
        </div>
    `;
    });



    // Agora sim: exibe a dieta na div #dieta (e não mais na #macros)
    document.getElementById('dieta').innerHTML = dietaHTML;
    document.getElementById('dieta').innerHTML += `
    
        <table>
            <thead>
                <tr>
                    <th>Fonte de Proteínas</th>
                    <th>Fonte de Carboidratos</th>
                    <th>Fonte de Gorduras</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Carne</td>
                    <td>Arroz (ex: arroz branco, arroz integral)</td>
                    <td>Abacate</td>
                </tr>
                <tr>
                    <td>Ovos</td>
                    <td>Macarrão (ex: espaguete, penne)</td>
                    <td>Azeite</td>
                </tr>
                <tr>
                    <td>Peixe</td>
                    <td>Pão (ex: pão integral, baguete)</td>
                    <td>Óleo de coco</td>
                </tr>
                <tr>
                    <td>Aves</td>
                    <td>Batatas</td>
                    <td>Peixes gordurosos (ex: salmão, cavala)</td>
                </tr>
                <tr>
                    <td>Leguminosas (ex: lentilhas, grão-de-bico)</td>
                    <td>Quinoa</td>
                    <td>Nozes (ex: amêndoas, nozes)</td>
                </tr>
                <tr>
                    <td>Nozes (ex: amêndoas, amendoins)</td>
                    <td>Aveia</td>
                    <td>Sementes (ex: sementes de chia, linhaça)</td>
                </tr>
                <tr>
                    <td>Sementes (ex: sementes de chia, sementes de girassol)</td>
                    <td>Cereais (ex: flocos de milho, aveia)</td>
                    <td>Manteigas de nozes (ex: manteiga de amêndoa, manteiga de amendoim)</td>
                </tr>
                <tr>
                    <td>Tofu</td>
                    <td>Feijões (ex: feijão preto, feijão vermelho)</td>
                    <td>Chocolate amargo (com alto teor de cacau)</td>
                </tr>
                <tr>
                    <td>Quinoa</td>
                    <td>Lentilhas</td>
                    <td>Iogurte integral</td>
                </tr>
                <tr>
                    <td>Laticínios (ex: queijo, iogurte)</td>
                    <td>Batata-doce</td>
                    <td>Queijo (com moderação)</td>
                </tr>
                <tr>
                    <td>Feijões (ex: feijão preto, feijão vermelho)</td>
                    <td>Cevada</td>
                    <td>Ovos (contêm gorduras saudáveis na gema)</td>
                </tr>
                <tr>
                    <td>Iogurte Grego</td>
                    <td>Milheto</td>
                    <td>Azeitonas</td>
                </tr>
                <tr>
                    <td>Queijo</td>
                    <td>Frutas (ex: bananas, maçãs)</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    `

    let totalKcal = (proteina * 4 + gordura * 9 + carboidrato * 4) / 3;

    document.getElementById('resultadosMacros').innerHTML = `
        <div class="box">
            <h4>Divisão da dieta:</h4>
            Proteína: <strong>${Math.round(proteina / 3)}g</strong><br>
            Gordura: <strong>${Math.round(gordura / 3)}g</strong><br>
            Carboidrato: <strong>${Math.round(carboidrato / 3)}g</strong>
        </div>
        <div class="box">
            <h4>Total calórico:</h4>
            <strong>${Math.round(totalKcal)} kcal por refeição</strong>
        </div>
    `;

});

function gerarPdf() {
    const tabela = document.querySelector('#dieta table');
    const dieta = document.getElementById('dieta');
    const result = document.getElementById('result');
    const resultadosMacros = document.getElementById('resultadosMacros');
    const macros = document.getElementById('macros');
    const novaJanela = window.open('', '', 'height=1000,width=1000');

    novaJanela.document.write(`
        <html>
            <head>
                <title>Dieta Personalizada</title>
                <style>
                    body { font-family: Arial, sans-serif; margin: 20px; display: flex; flex-direction: column; aling-items: center; }
                    .box, #result { margin: 20px auto; padding: 20px; width: fit-content; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); background: white; }
                    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                    thead { background: #D32F2F; color: white; }
                    th, td { padding: 5px; text-align: center; border: 1px solid #ddd; }
                    tbody tr:nth-child(even) { background: #f9f9f9; }
                </style>
            </head>
            <body>
                ${result.outerHTML}
                ${macros.outerHTML}
                ${resultadosMacros.outerHTML}
                ${dieta.outerHTML}
                ${tabela.outerHTML}
            </body>
        </html>
    `);

    novaJanela.document.close();
    novaJanela.focus();
    novaJanela.print();
    novaJanela.close();
}