CREATE SCHEMA IF NOT EXISTS rcs DEFAULT CHARACTER SET utf8 ;
USE rcs ;

-- -----------------------------------------------------
-- Tabela para usuários
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS rcs.usuario (
  idUsuario INT NOT NULL AUTO_INCREMENT,
  nomeUsuario VARCHAR(45) NOT NULL,
  emailUsuario VARCHAR(45) NOT NULL,
  senhaUsuario VARCHAR(32) NOT NULL,
  PRIMARY KEY (idUsuario));

-- -----------------------------------------------------
-- Tabela de finalidades
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS rcs.finalidade (
  idFinalidade INT NOT NULL AUTO_INCREMENT,
  nomeFinalidade VARCHAR(45) NOT NULL,
  descFinalidade VARCHAR(200) NOT NULL,
  PRIMARY KEY (idFinalidade));

-- -----------------------------------------------------
-- Tabela de consentimentos que é onde relaciona os usuários e as finalidades
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS rcs.consentimentos (
  usuario_idUsuario INT NOT NULL,
  finalidade_idFinalidade INT NOT NULL,
  PRIMARY KEY (usuario_idUsuario, finalidade_idFinalidade),
  INDEX fk_usuario_has_finalidade_finalidade1_idx (finalidade_idFinalidade ASC) VISIBLE,
  INDEX fk_usuario_has_finalidade_usuario_idx (usuario_idUsuario ASC) VISIBLE,
  CONSTRAINT fk_usuario_has_finalidade_usuario
    FOREIGN KEY (usuario_idUsuario)
    REFERENCES rcs.usuario (idUsuario)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_usuario_has_finalidade_finalidade1
    FOREIGN KEY (finalidade_idFinalidade)
    REFERENCES rcs.finalidade (idFinalidade)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Inserts para teste
-- -----------------------------------------------------

INSERT INTO usuario (nomeUsuario, emailUsuario, senhaUsuario) VALUES
("Cleiton", "cleiton@gmail.com", "12345678"),
("Bruno", "bruno@gmail.com", "abcdefgh");

INSERT INTO finalidade (nomeFinalidade, descFinalidade) VALUES
("Marketing por e-mail", "Consentimento para receber comunicações promocionais e newsletters por e-mail."),
("Compartilhamento de dados com terceiros", "Consentimento para compartilhar informações do usuário com parceiros ou outras empresas para fins específicos.");

INSERT INTO consentimentos (usuario_idUsuario, finalidade_idFinalidade) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2);