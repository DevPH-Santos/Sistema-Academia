-- Selecione/crie o banco pelo painel ou phpMyAdmin antes de importar este arquivo.
-- Este arquivo contém apenas as tabelas; não executa CREATE DATABASE nem USE.

CREATE TABLE IF NOT EXISTS Cadastrar (
    pk_cod_cadastrar INT NOT NULL AUTO_INCREMENT,
    rg_cadastrar DECIMAL(9,0) DEFAULT NULL,
    cpf_cadastrar DECIMAL(11,0) DEFAULT NULL,
    nome_cadastrar VARCHAR(50) NOT NULL,
    data_inicio_cadastrar DATE NOT NULL,
    forma_pag_cadastrar VARCHAR(15) NOT NULL,
    preco_plano_cadastrar DECIMAL(4,0) NOT NULL,
    tipo_plano_cadastrar VARCHAR(15) NOT NULL,
    nome_responsavel_cadastrar VARCHAR(50) DEFAULT NULL,
    telefone_cadastrar VARCHAR(15) DEFAULT NULL,
    PRIMARY KEY (pk_cod_cadastrar)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS avaliacao (
    pk_cod_avaliacao INT NOT NULL AUTO_INCREMENT,
    nome_avaliacao VARCHAR(50) DEFAULT NULL,
    peso_avaliacao DECIMAL(5,2) DEFAULT NULL,
    objetivo_avaliacao VARCHAR(20) DEFAULT NULL,
    peito_avaliacao DECIMAL(5,2) DEFAULT NULL,
    braco_esq_avaliacao DECIMAL(4,2) DEFAULT NULL,
    braco_dir_avaliacao DECIMAL(4,2) DEFAULT NULL,
    cintura_avaliacao DECIMAL(5,2) DEFAULT NULL,
    culote_avaliacao DECIMAL(5,2) DEFAULT NULL,
    abdomen_avaliacao DECIMAL(5,2) DEFAULT NULL,
    quadril_avaliacao DECIMAL(5,2) DEFAULT NULL,
    coxa_esq_avaliacao DECIMAL(5,2) DEFAULT NULL,
    coxa_dir_avaliacao DECIMAL(5,2) DEFAULT NULL,
    panturrilha_esq_avaliacao DECIMAL(5,2) DEFAULT NULL,
    panturrilha_dir_avaliacao DECIMAL(5,2) DEFAULT NULL,
    data_avaliacao DATE DEFAULT NULL,
    PRIMARY KEY (pk_cod_avaliacao)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS agenda (
    pk_cod_agenda INT NOT NULL AUTO_INCREMENT,
    cliente_agenda VARCHAR(30) NOT NULL,
    data_agenda DATETIME NOT NULL,
    motivo_agenda VARCHAR(30) DEFAULT NULL,
    PRIMARY KEY (pk_cod_agenda)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS Bioimpedancia (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    data DATE NOT NULL,
    peso DECIMAL(5,2) NOT NULL,
    massa_magra DECIMAL(5,2) NOT NULL,
    massa_gorda DECIMAL(5,2) NOT NULL,
    gordura_corporal DECIMAL(5,2) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS Anamnese (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    idade INT NOT NULL,
    ja_treinou ENUM('Sim', 'Não') NOT NULL,
    tempo_treinando VARCHAR(50) NOT NULL,
    tempo_sem_atividade VARCHAR(50) NOT NULL,
    objetivo VARCHAR(255) NOT NULL,
    frequencia_semanal INT NOT NULL,
    tempo_treino_por_dia INT NOT NULL,
    doenca_problema_saude VARCHAR(255) NOT NULL,
    limitacao_movimento VARCHAR(255) NOT NULL,
    dor_em_movimento VARCHAR(255) NOT NULL,
    cirurgias VARCHAR(255) NOT NULL,
    medicamento_controlado VARCHAR(255) NOT NULL,
    dieta ENUM('Sim', 'Não') NOT NULL,
    consumo_alcool ENUM('Sim', 'Não') NOT NULL,
    fuma ENUM('Sim', 'Não') NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY uq_anamnese_nome (nome)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
