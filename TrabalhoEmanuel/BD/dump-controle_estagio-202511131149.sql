CREATE TABLE `aluno` (
  `id_aluno` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `matricula` varchar(50) NOT NULL,
  `curso` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_aluno`)
);

CREATE TABLE `inscricao_atividade` (
  `id_inscricao` int NOT NULL AUTO_INCREMENT,
  `id_aluno` int NOT NULL,
  `apostila` varchar(30) NOT NULL,
  `horas_validadas` decimal(6,2) DEFAULT '0.00',
  `data_validacao` date DEFAULT NULL,
  `status` varchar(50) DEFAULT 'pendente',
  `observacoes` text,
  PRIMARY KEY (`id_inscricao`)
);

CREATE TABLE `monitores` (
  `id_monitor` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_monitor`)
);

CREATE TABLE `relatorios_estagio` (
  `id_relatorio` int NOT NULL AUTO_INCREMENT,
  `id_aluno` int DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descricao` text,
  `data_entrega` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `observacoes` text,
  PRIMARY KEY (`id_relatorio`)
);
