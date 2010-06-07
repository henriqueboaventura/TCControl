CREATE TABLE administrador (id BIGINT AUTO_INCREMENT, nome VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL UNIQUE, senha VARCHAR(128) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM;
CREATE TABLE aluno (id BIGINT AUTO_INCREMENT, nome VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL UNIQUE, senha VARCHAR(128) NOT NULL, matricula VARCHAR(20) NOT NULL UNIQUE, endereco VARCHAR(200) NOT NULL, fone_residencial VARCHAR(20) NOT NULL, fone_celular VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM;
CREATE TABLE area_afinidade (id BIGINT AUTO_INCREMENT, nome VARCHAR(50) NOT NULL, slug VARCHAR(255), UNIQUE INDEX area_afinidade_sluggable_idx (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM;
CREATE TABLE area_interesse (id BIGINT AUTO_INCREMENT, professor_id BIGINT NOT NULL, nome VARCHAR(50) NOT NULL, INDEX professor_id_idx (professor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM;
CREATE TABLE professor (id BIGINT AUTO_INCREMENT, nome VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL UNIQUE, senha VARCHAR(128) NOT NULL, matricula VARCHAR(20) NOT NULL UNIQUE, endereco VARCHAR(200) NOT NULL, fone_residencial VARCHAR(20) NOT NULL, fone_celular VARCHAR(20) NOT NULL, coordenador TINYINT(1) DEFAULT '0' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM;
CREATE TABLE professor_area_afinidade (professor_id INT, area_afinidade_id INT, PRIMARY KEY(professor_id, area_afinidade_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM;
ALTER TABLE area_interesse ADD CONSTRAINT area_interesse_professor_id_professor_id FOREIGN KEY (professor_id) REFERENCES professor(id);
ALTER TABLE professor_area_afinidade ADD CONSTRAINT professor_area_afinidade_professor_id_professor_id FOREIGN KEY (professor_id) REFERENCES professor(id);
ALTER TABLE professor_area_afinidade ADD CONSTRAINT professor_area_afinidade_area_afinidade_id_area_afinidade_id FOREIGN KEY (area_afinidade_id) REFERENCES area_afinidade(id);
