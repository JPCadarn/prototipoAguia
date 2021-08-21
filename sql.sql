CREATE TABLE clientes(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(200) NOT NULL,
	data_nascimento DATE NOT NULL,
	cpf_cnpj VARCHAR (14) NOT NULL,
	endereco VARCHAR(200) NOT NULL,
	telefone VARCHAR(20) NOT NULL,
	email VARCHAR(200) NOT NULL,
	datetime_cadastro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	datetime_atualizacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	chave VARCHAR(60) UNIQUE
);

CREATE TABLE usuarios(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(200) NOT NULL,
	email VARCHAR(200) NOT NULL UNIQUE,
	senha VARCHAR(60) NOT NULL,
	id_cliente INT NOT NULL REFERENCES clientes(id),
	chave VARCHAR(60) NOT NULL,
	tipo ENUM('normal','admin','aguia') NOT NULL
);

INSERT INTO usuarios (nome, email, senha, id_cliente, chave) VALUES ('ADMIN', 'ADMIN', '$2y$10$EDunD4N4R5yOAvLgJH38WeccvPSnnmNCJWpwpanJF1BFZGQ8uyLg6', 0, 'aguia');

CREATE TABLE pontes(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(50),
	descricao TEXT,
	via VARCHAR(50),
	data_construcao DATE,
	trem_tipo VARCHAR(50),
	sentido VARCHAR(50),
	localizacao VARCHAR(100),
	latitude VARCHAR(100),
	longitude VARCHAR(100),
	projetista VARCHAR(100),
	construtor VARCHAR(100),
	comprimento_estrutura NUMERIC(8,2),
	largura_estrutura NUMERIC(8,2),
	largura_acostamento NUMERIC(8,2),
	largura_refugio NUMERIC(8,2),
	largura_passeio NUMERIC(8,2),
	sistema_construtivo VARCHAR(50),
	natureza_transposicao VARCHAR(50),
	material_construcao VARCHAR(50),
	longitudinal_super VARCHAR(50),
	transversal_super VARCHAR(50),
	mesoestrutura_tipo VARCHAR(50),
	nro_vaos INT,	
	nro_apoios INT,	
	nro_pilares_apoio INT,	
	aparelhos_apoio VARCHAR(50),
	comprimento_vao_tipico NUMERIC(8,2),
	comprimento_maior_vao NUMERIC(8,2),
	altura_pilares NUMERIC(8,2),
	juntas_dilatacao VARCHAR(50),
	encontros INT,
	outras TEXT,
	caracteristicas_plani VARCHAR(100),
	nro_faixas INT,
	acostamento VARCHAR(50),
	refugios VARCHAR(50),
	passeio VARCHAR(50),
	barreira_rigida VARCHAR(50),
	material_pavimento VARCHAR(50),
	pingadeiras VARCHAR(50),
	guarda_corpo VARCHAR(50),
	drenos VARCHAR(50),
	freq_passagem_carga VARCHAR(50),
	superestrutura VARCHAR(50),
	mesoestrutura VARCHAR(50),
	infraestrutura VARCHAR(50),
	aparelhos_apoio_anomalia VARCHAR(50),
	juntas_dilatacao_anomalia VARCHAR(50),
	encontros_anomalia VARCHAR(50),
	pavimento_anomalia VARCHAR(50),
	acostamento_refugio_anomalia VARCHAR(50),
	drenagem_anomalia VARCHAR(50),
	guarda_corpo_anomalia VARCHAR(50),
	barreira_defesa VARCHAR(50),
	taludes VARCHAR(50),
	iluminacao VARCHAR(50),
	sinalizacao VARCHAR(50),
	protecao_pilares VARCHAR(50),
	id_usuario INT NOT NULL REFERENCES usuarios(id)
);

CREATE TABLE imagens_pontes(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	ponte_id INT NOT NULL REFERENCES pontes(id),
	imagem VARCHAR(200) NOT NULL,
	id_usuario INT NOT NULL REFERENCES usuarios(id)
);

CREATE TABLE agendamentos(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	data DATE NOT NULL,
	horario TIME NOT NULL,
	detalhes TEXT NOT NULL,
	ponte_id INT NOT NULL REFERENCES pontes(id),
	id_usuario INT NOT NULL REFERENCES usuarios(id)
);

DROP TABLE IF EXISTS inspecoes;

CREATE TABLE inspecoes(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	ponte_id INT NOT NULL REFERENCES pontes(id),
	nome VARCHAR(200) NOT NULL,
	descricao VARCHAR(200) NOT NULL,
	via VARCHAR(200) NOT NULL,
	data_construcao VARCHAR(200) NOT NULL,
	trem_tipo VARCHAR(200) NOT NULL,
	sentido VARCHAR(200) NOT NULL,
	localizacao VARCHAR(200) NOT NULL,
	latitude VARCHAR(200) NOT NULL,
	longitude VARCHAR(200) NOT NULL,
	projetista VARCHAR(200) NOT NULL,
	construtor VARCHAR(200) NOT NULL,
	comprimento_estrutura VARCHAR(200) NOT NULL,
	largura_estrutura VARCHAR(200) NOT NULL,
	largura_acostamento VARCHAR(200) NOT NULL,
	largura_refugio VARCHAR(200) NOT NULL,
	largura_passeio VARCHAR(200) NOT NULL,
	sistema_construtivo VARCHAR(200) NOT NULL,
	natureza_transposicao VARCHAR(200) NOT NULL,
	material_construcao VARCHAR(200) NOT NULL,
	longitudinal_super VARCHAR(200) NOT NULL,
	transversal_super VARCHAR(200) NOT NULL,
	mesoestrutura_tipo VARCHAR(200) NOT NULL,
	nro_vaos VARCHAR(200) NOT NULL,	
	nro_apoios VARCHAR(200) NOT NULL,	
	nro_pilares_apoio VARCHAR(200) NOT NULL,	
	aparelhos_apoio VARCHAR(200) NOT NULL,
	comprimento_vao_tipico VARCHAR(200) NOT NULL,
	comprimento_maior_vao VARCHAR(200) NOT NULL,
	altura_pilares VARCHAR(200) NOT NULL,
	juntas_dilatacao VARCHAR(200) NOT NULL,
	encontros VARCHAR(200) NOT NULL,
	outras VARCHAR(200) NOT NULL,
	caracteristicas_plani VARCHAR(200) NOT NULL,
	nro_faixas VARCHAR(200) NOT NULL,
	acostamento VARCHAR(200) NOT NULL,
	refugios VARCHAR(200) NOT NULL,
	passeio VARCHAR(200) NOT NULL,
	barreira_rigida VARCHAR(200) NOT NULL,
	material_pavimento VARCHAR(200) NOT NULL,
	pingadeiras VARCHAR(200) NOT NULL,
	guarda_corpo VARCHAR(200) NOT NULL,
	drenos VARCHAR(200) NOT NULL,
	freq_passagem_carga VARCHAR(200) NOT NULL,
	superestrutura VARCHAR(200) NOT NULL,
	mesoestrutura VARCHAR(200) NOT NULL,
	infraestrutura VARCHAR(200) NOT NULL,
	aparelhos_apoio_anomalia VARCHAR(200) NOT NULL,
	juntas_dilatacao_anomalia VARCHAR(200) NOT NULL,
	encontros_anomalia VARCHAR(200) NOT NULL,
	pavimento_anomalia VARCHAR(200) NOT NULL,
	acostamento_refugio_anomalia VARCHAR(200) NOT NULL,
	drenagem_anomalia VARCHAR(200) NOT NULL,
	guarda_corpo_anomalia VARCHAR(200) NOT NULL,
	barreira_defesa VARCHAR(200) NOT NULL,
	taludes VARCHAR(200) NOT NULL,
	iluminacao VARCHAR(200) NOT NULL,
	sinalizacao VARCHAR(200) NOT NULL,
	protecao_pilares VARCHAR(200) NOT NULL,
	id_usuario INT NOT NULL REFERENCES usuarios(id)
);

CREATE TABLE imagens_inspecoes(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	inspecao_id INT NOT NULL REFERENCES inspecoes(id),
	imagem VARCHAR(200) NOT NULL,
	id_usuario INT NOT NULL REFERENCES usuarios(id)
);

ALTER TABLE inspecoes 
ADD nota_indice_localizacao DECIMAL(10, 2) NOT NULL, 
ADD nota_indice_volume_trafego DECIMAL(10, 2) NOT NULL, 
ADD nota_indice_largura_oae DECIMAL(10, 2) NOT NULL, 
ADD nota_geometria_condicoes DECIMAL(10, 2) NOT NULL, 
ADD nota_acessos DECIMAL(10, 2) NOT NULL, 
ADD nota_cursos_agua DECIMAL(10, 2) NOT NULL, 
ADD nota_encontros_fundacoes DECIMAL(10, 2) NOT NULL, 
ADD nota_apoios_intermediarios DECIMAL(10, 2) NOT NULL, 
ADD nota_aparelhos_apoio DECIMAL(10, 2) NOT NULL, 
ADD nota_superestrutura DECIMAL(10, 2) NOT NULL, 
ADD nota_pista_rolamento DECIMAL(10, 2) NOT NULL, 
ADD nota_juntas_dilatacao DECIMAL(10, 2) NOT NULL, 
ADD nota_barreiras_guardacorpos DECIMAL(10, 2) NOT NULL, 
ADD nota_sinalizacao DECIMAL(10, 2) NOT NULL, 
ADD nota_instalacoes_util_publica DECIMAL(10, 2) NOT NULL, 
ADD nota_largura_plataforma DECIMAL(10, 2) NOT NULL, 
ADD nota_capacidade_carga DECIMAL(10, 2) NOT NULL, 
ADD nota_superficie_plataforma DECIMAL(10, 2) NOT NULL, 
ADD nota_pista_rolamento_fc DECIMAL(10, 2) NOT NULL, 
ADD nota_outros_fc DECIMAL(10, 2) NOT NULL, 
ADD nota_espaco_livre DECIMAL(10, 2) NOT NULL, 
ADD nota_localizacao_ponte DECIMAL(10, 2) NOT NULL, 
ADD nota_saude_fisica_ponte DECIMAL(10, 2) NOT NULL, 
ADD nota_outros_fi DECIMAL(10, 2) NOT NULL,
ADD tipo_inspecao ENUM('cadastral', 'rotineira', 'especial', 'extraordinaria');