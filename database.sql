SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

INSERT INTO `modulos` (`nome`, `url`, `icone`, `status`, `ordem`, `tabela`, `cod_head`, `data_atualizacao`, `chave`)
SELECT 'Ecommerce', 'ecommerce.php', 'icon-shopping-bag', 1, 0, 'ecommerce', 'ecommerce/ecommerce.js', '2019-05-07', '72b4b1d7ce2b514a981a49b1db5790a7';

-- CATEGORIA
CREATE TABLE IF NOT EXISTS `ecommerce_categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ATRIBUTOS
CREATE TABLE IF NOT EXISTS `ecommerce_atributos` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `nome` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `descricao` text CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- MARCAS
CREATE TABLE IF NOT EXISTS `ecommerce_marcas` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `descricao` text CHARACTER SET utf8 DEFAULT NULL,
  `imagem` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- TERMOS
CREATE TABLE IF NOT EXISTS `ecommerce_termos` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_atributo` int(11) DEFAULT NULL,
  `nome` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- PRODUTO
CREATE TABLE IF NOT EXISTS `ecommerce` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(255) NOT NULL,
  `resumo` text DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `codigo` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `palavras_chave` text NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `etiqueta` varchar(255) DEFAULT NULL,
  `etiqueta_cor` varchar(255) DEFAULT NULL,
  `a_consultar` enum('S','N') DEFAULT 'N',
  `estoque` int(11) DEFAULT NULL,
  `link_venda` varchar(255) DEFAULT NULL,
  `id_imagem_capa` int(11) DEFAULT NULL,
  `btn_texto` varchar(255) DEFAULT NULL,
  `click` int(11) DEFAULT 0,
  `view` int(11) DEFAULT 0,
  `target_link` enum('_self','_blank') NOT NULL DEFAULT '_self',
  `ordem_manual` int(11) DEFAULT NULL,
  `count_add_cart` int(11) DEFAULT 0,
  `diminuir_est` varchar(255) DEFAULT NULL,
  `peso` varchar(255) DEFAULT NULL,
  `comprimento` varchar(255) DEFAULT NULL,
  `altura` varchar(255) DEFAULT NULL,
  `largura` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- PRODUTO - CATEGORIAS
CREATE TABLE IF NOT EXISTS `ecommerce_prod_categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_produto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- PRODUTO - TERMOS
CREATE TABLE IF NOT EXISTS `ecommerce_prod_termos` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_produto` int(11) DEFAULT NULL,
  `id_atributo` int(11) DEFAULT NULL,
  `id_termo` int(11) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- PRODUTO - MARCAS
CREATE TABLE IF NOT EXISTS `ecommerce_prod_marcas` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_produto` int(11) DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- PRODUTO - ATRIBUTOS
CREATE TABLE IF NOT EXISTS `ecommerce_prod_atributos` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_produto` int(11) DEFAULT NULL,
  `id_atributos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- PRODUTO - IMAGENS
CREATE TABLE IF NOT EXISTS `ecommerce_prod_imagens` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_produto` int(11) NOT NULL,
  `uniq` varchar (255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- PRODUTO - PRODUTOS RELACIONADOS
CREATE TABLE IF NOT EXISTS `ecommerce_prod_relacionados` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_produto` int(11) NOT NULL,
  `id_produto_relacionado` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- LISTAGEM
CREATE TABLE IF NOT EXISTS `ecommerce_listas` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `titulo` varchar(255) NOT NULL,
  `ordenar_por` varchar(255) NOT NULL,
  `asc_desc` enum('ASC','DESC') NOT NULL DEFAULT 'ASC',
  `colunas` int(11) NOT NULL,
  `mostrar_paginacao` enum('S', 'N') DEFAULT 'N',
  `mostrar_filtro` enum('S', 'N') DEFAULT 'S',
  `paginacao` int(11),
  `efeito` varchar(100) DEFAULT NULL,
  `tipo` enum('1','2','3','4','5') DEFAULT '1',
  `carrocel` enum('S', 'N') DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- LISTAGEM - CATEGORIAS
CREATE TABLE IF NOT EXISTS `ecommerce_lista_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_lista` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- CONFIGURAÇÃO DO CATALOGO
CREATE TABLE IF NOT EXISTS `ecommerce_config` (
  `id` varchar(255) NOT NULL,
  `valor` varchar(255) DEFAULT NULL,
  UNIQUE (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- VENDAS
CREATE TABLE IF NOT EXISTS `ecommerce_vendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(255) NOT NULL,
  `tipo_pessoa` varchar(255) NOT NULL,
  `id_pessoa` varchar(255) NOT NULL,
  `cep` varchar(255) NOT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `rua` text NOT NULL,
  `numero` varchar(255) NOT NULL,
  `complemento` text NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `telefone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nota` text DEFAULT NULL,
  `tipo_entrega` varchar(255) NOT NULL,
  `valor` float NOT NULL,
  `produto` text NOT NULL,
  `rastreamento` text NULL,
  `status` varchar(255) NOT NULL,
  `data` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
ALTER TABLE `ecommerce_vendas` ADD  AFTER `data`, ADD  AFTER `rastreamento`;

INSERT INTO `ecommerce_config` (`id`, `valor`) VALUES
('pagina_carrinho', ''),
('pagina_resultado_busca', ''),
('pagina_checkout', ''),
('email_servidor', ''),
('email_usuario', ''),
('email_senha', ''),
('email_porta', ''),
('email_protocolo_seguranca', 'ssl'),
('email_disparo', ''),
('email_recebimento', ''),
('email_cor_bg', ''),
('email_cor_header_bg', ''),
('email_cor_header_texto', ''),
('matriz_produto', ''),
('listagem_cor_titulo', ''),
('listagem_cor_preco', ''),
('listagem_cor_borda', ''),
('listagem_cor_botao', ''),
('listagem_cor_hover_botao', ''),
('listagem_cor_filtro', ''),
('listagem_estilo', ''),
('busca_btn_tipo', 'ambos'),
('busca_btn_cor', ''),
('busca_btn_cor_hover', ''),
('busca_btn_tamanho', 'normal'),
('btn_carrinho_cor_btn_meu_carrinho', ''),
('btn_carrinho_cor_fundo', ''),
('btn_carrinho_cor_texto', ''),
('btn_carrinho_cor_btn_ver_carrinho', ''),
('btn_carrinho_cor_hover_btn_ver_carrinho', ''),
('btn_carrinho_cor_texto_btn_ver_carrinho', ''),
('produto_cor_titulo', ''),
('produto_cor_texto_botao', ''),
('produto_cor_preco', ''),
('produto_cor_botao', ''),
('produto_cor_hover_botao', ''),
('produto_cor_texto_descricao', ''),
('produto_cor_tag_categoria', ''),
('produto_cor_texto_tag_categoria', ''),
('busca_limite_pagina', '10'),
('busca_btn_cor_texto', ''),
('carrocel_cor_btn', ''),
('carrocel_cor_hover_btn', ''),
('carrocel_cor_btn_texto', ''),
('carrocel_cor_titulo', ''),
('carrocel_cor_hover_titulo', ''),
('carrocel_cor_descricao', ''),
('carrocel_cor_setas', ''),
('carrocel_cor_hover_setas', ''),
('carrinho_cor_btns', ''),
('carrinho_cor_btn_finalizar', ''),
('moeda', 'R&#x00024;'),
('cep_origem', '');


UPDATE `modulos` SET `acao` = "{\"listagem\":[\"adicionar\",\"editar\",\"deletar\"],\"categoria\":[\"adicionar\",\"editar\",\"deletar\"],\"produto\":[\"adicionar\",\"editar\",\"deletar\"],\"codigo\":[\"acessar\"],\"configuracao\":[\"acessar\"]}" WHERE `modulos`.`url` = 'ecommerce.php';

SELECT * FROM `ecommerce_vendas` ORDER BY 'data' DESC;
SET @@time_zone = '+03:00';