create schema BLOG;

-- Table UTILISATEUR
create table UTILISATEUR (PSEUDO char(20) not null,
					MOTDEPASSE char(20) not null,
					MAIL char(20) not null,
				primary key (PSEUDO));

-- Table COMMENTAIRE					
create table COMMENTAIRE (TITRECOM char(20) not null,
					DATEPUBLI int(8) not null,
					NUMPAGECOM int(5) not null,
					CONTENU char(2000) not null,
					PSEUDO char(20) not null,
					TITREART char(20) not null,
				primary key (TITRECOM,PSEUDO,TITREART),
				second key (DATEPUBLI)
				foreign key (PSEUDO) references UTILISATEUR
					on delete no cascade on update cascade,
				foreign key (TITREART) references ARTICLE
					on delete cascade on update no action);

-- Table ARTICLE				
create table ARTICLE (TITREART char(20) not null,
					DATEART int(8) not null,
					NUMPAGEART int(5) not null,
					LIBELLE char(20) not null,
					NOMCAT char(20) not null,
				primary key (TITREART,DATEART,LIBELLE,NOMCAT),
				foreign key (LIBELLE) references TAG
					on delete no action on update cascade,
				foreign key (NOMCAT) references CATEGORIE
					on delete cascade on update cascade);
						
-- Table TAG	
create table TAG (LIBELLE char(20) not null,
				primary key (LIBELLE));

-- Table CATEGORIE	
create table CATEGORIE (NOMCAT char(20) not null,
				primary key (NOMCAT));
	
	
-- INDEX : clés primaires	
	-- table UTILISATEUR
create index XUTI_PSEUDO on UTILISATEUR(PSEUDO);
	-- Index COMMENTAIRE
create index XCOM_TITRECOM on COMMENTAIRE(TITRECOM);
create index XCOM_DATEPUBLI on COMMENTAIRE(DATEPUBLI);
	-- table ARTICLE
create index XART_TITREART on ARTICLE(TITREART);
create index XART_DATEART on ARTICLE(DATEART);
	-- table CATEGORIE
create index XCAT_NOMCAT on CATEGORIE(NOMCAT);
	-- table TAG
create index XTAG_LIBELLE on TAG(LIBELLE);

-- INDEX : clés étrangères
	-- table COMMENTAIRE
create index XCOM_PSEUDO on COMMENTAIRE(PSEUDO);
create index XCOM_TITREART on COMMENTAIRE(TITREART);
	-- table ARTICLE
create index XART_LIBELLE on ARTICLE(LIBELLE);
create index XART_NOMCAT on ARTICLE(NOMCAT);