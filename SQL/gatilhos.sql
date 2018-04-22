use sepe;

DELIMITER $

CREATE TRIGGER excluir_evento BEFORE DELETE
ON evento
FOR EACH ROW
BEGIN
	delete from acontecimento where id_evento=old.id;
	delete from inscricao_evento where id_evento=old.id;
	delete from artigo where id_evento=old.id;


END$



DELIMITER $

CREATE TRIGGER excluir_acontecimento BEFORE DELETE
ON acontecimento
FOR EACH ROW
BEGIN
	delete from frequencia_acontecimento where id_acontecimento=old.id;
	delete from inscricao_acontecimento where id_acontecimento=old.id;

END$



DELIMITER $

CREATE TRIGGER excluir_usuario BEFORE DELETE
ON usuario
FOR EACH ROW
BEGIN
	delete from acontecimento  where id_usuario=old.id;
	delete from inscricao_evento where id_participante=old.id;
	delete from inscricao_acontecimento where id_participante=old.id;
	delete from frequencia_acontecimento where id_participante=old.id;
	delete from artigo where id_participante=old.id;
	delete from propostas where id_participante=old.id;


END$