--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.5
-- Dumped by pg_dump version 9.5.5

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner:
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner:
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- Name: pgcrypto; Type: EXTENSION; Schema: -; Owner:
--

CREATE EXTENSION IF NOT EXISTS pgcrypto WITH SCHEMA public;


--
-- Name: EXTENSION pgcrypto; Type: COMMENT; Schema: -; Owner:
--

COMMENT ON EXTENSION pgcrypto IS 'cryptographic functions';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: comment; Type: TABLE; Schema: public; Owner: meneame
--

drop table if exists categorias cascade;
drop table if exists entradas cascade;
drop table if exists etiquetas cascade;
drop table if exists entradas_etiquetas cascade;
drop table if exists public.user cascade;
drop table if exists public.comment cascade;
drop table if exists meneos cascade;
drop table if exists public.token cascade;
drop table if exists public.social_account cascade;
drop table if exists public.profile cascade;
drop table if exists public.migration cascade;

CREATE TABLE comment (
    id integer NOT NULL,
    entity character(10) NOT NULL,
    "entityId" integer NOT NULL,
    content text NOT NULL,
    "parentId" integer,
    level smallint DEFAULT 1 NOT NULL,
    "createdBy" integer NOT NULL,
    "updatedBy" integer NOT NULL,
    status smallint DEFAULT 1 NOT NULL,
    "createdAt" integer NOT NULL,
    "updatedAt" integer NOT NULL,
    "relatedTo" character varying(500) NOT NULL,
    url text
);


ALTER TABLE comment OWNER TO meneame;

--
-- Name: Comment_id_seq; Type: SEQUENCE; Schema: public; Owner: meneame
--

CREATE SEQUENCE "Comment_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Comment_id_seq" OWNER TO meneame;

--
-- Name: Comment_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: meneame
--

ALTER SEQUENCE "Comment_id_seq" OWNED BY comment.id;


--
-- Name: social_account; Type: TABLE; Schema: public; Owner: meneame
--

CREATE TABLE social_account (
    id integer NOT NULL,
    user_id integer,
    provider character varying(255) NOT NULL,
    client_id character varying(255) NOT NULL,
    data text,
    code character varying(32) DEFAULT NULL::character varying,
    created_at integer,
    email character varying(255) DEFAULT NULL::character varying,
    username character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE social_account OWNER TO meneame;

--
-- Name: account_id_seq; Type: SEQUENCE; Schema: public; Owner: meneame
--

CREATE SEQUENCE account_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE account_id_seq OWNER TO meneame;

--
-- Name: account_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: meneame
--

ALTER SEQUENCE account_id_seq OWNED BY social_account.id;


--
-- Name: categorias; Type: TABLE; Schema: public; Owner: meneame
--

CREATE TABLE categorias (
    id bigint NOT NULL,
    nombre character varying(20) NOT NULL
);


ALTER TABLE categorias OWNER TO meneame;

--
-- Name: categorias_id_seq; Type: SEQUENCE; Schema: public; Owner: meneame
--

CREATE SEQUENCE categorias_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE categorias_id_seq OWNER TO meneame;

--
-- Name: categorias_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: meneame
--

ALTER SEQUENCE categorias_id_seq OWNED BY categorias.id;


--
-- Name: entradas; Type: TABLE; Schema: public; Owner: meneame
--

CREATE TABLE entradas (
    id bigint NOT NULL,
    url character varying(255) NOT NULL,
    titulo character varying(120) NOT NULL,
    texto character varying(550) NOT NULL,
    usuario_id integer NOT NULL,
    created_at timestamp with time zone DEFAULT now() NOT NULL,
    categoria_id bigint NOT NULL
);


ALTER TABLE entradas OWNER TO meneame;

--
-- Name: entradas_etiquetas; Type: TABLE; Schema: public; Owner: meneame
--

CREATE TABLE entradas_etiquetas (
    entrada_id bigint NOT NULL,
    etiqueta_id bigint NOT NULL
);


ALTER TABLE entradas_etiquetas OWNER TO meneame;

--
-- Name: entradas_id_seq; Type: SEQUENCE; Schema: public; Owner: meneame
--

CREATE SEQUENCE entradas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE entradas_id_seq OWNER TO meneame;

--
-- Name: entradas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: meneame
--

ALTER SEQUENCE entradas_id_seq OWNED BY entradas.id;


--
-- Name: etiquetas; Type: TABLE; Schema: public; Owner: meneame
--

CREATE TABLE etiquetas (
    id bigint NOT NULL,
    nombre character varying(100) NOT NULL
);


ALTER TABLE etiquetas OWNER TO meneame;

--
-- Name: etiquetas_id_seq; Type: SEQUENCE; Schema: public; Owner: meneame
--

CREATE SEQUENCE etiquetas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE etiquetas_id_seq OWNER TO meneame;

--
-- Name: etiquetas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: meneame
--

ALTER SEQUENCE etiquetas_id_seq OWNED BY etiquetas.id;


--
-- Name: migration; Type: TABLE; Schema: public; Owner: meneame
--

CREATE TABLE migration (
    version character varying(180) NOT NULL,
    apply_time integer
);


ALTER TABLE migration OWNER TO meneame;

--
-- Name: profile; Type: TABLE; Schema: public; Owner: meneame
--

CREATE TABLE profile (
    user_id integer NOT NULL,
    name character varying(255) DEFAULT NULL::character varying,
    public_email character varying(255) DEFAULT NULL::character varying,
    gravatar_email character varying(255) DEFAULT NULL::character varying,
    gravatar_id character varying(32) DEFAULT NULL::character varying,
    location character varying(255) DEFAULT NULL::character varying,
    website character varying(255) DEFAULT NULL::character varying,
    bio text,
    timezone character varying(40) DEFAULT NULL::character varying
);


ALTER TABLE profile OWNER TO meneame;

--
-- Name: token; Type: TABLE; Schema: public; Owner: meneame
--

CREATE TABLE token (
    user_id integer NOT NULL,
    code character varying(32) NOT NULL,
    created_at integer NOT NULL,
    type smallint NOT NULL
);


ALTER TABLE token OWNER TO meneame;

--
-- Name: user; Type: TABLE; Schema: public; Owner: meneame
--

CREATE TABLE "user" (
    id integer NOT NULL,
    username character varying(25) NOT NULL,
    email character varying(255) NOT NULL,
    password_hash character varying(60) NOT NULL,
    auth_key character varying(32) NOT NULL,
    confirmed_at integer,
    unconfirmed_email character varying(255) DEFAULT NULL::character varying,
    blocked_at integer,
    registration_ip character varying(45),
    created_at integer NOT NULL,
    updated_at integer NOT NULL,
    flags integer DEFAULT 0 NOT NULL,
    last_login_at integer
);


ALTER TABLE "user" OWNER TO meneame;

--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: meneame
--

CREATE SEQUENCE user_id_seq
    START WITH 2
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE user_id_seq OWNER TO meneame;

--
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: meneame
--

ALTER SEQUENCE user_id_seq OWNED BY "user".id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: meneame
--

ALTER TABLE ONLY categorias ALTER COLUMN id SET DEFAULT nextval('categorias_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: meneame
--

ALTER TABLE ONLY comment ALTER COLUMN id SET DEFAULT nextval('"Comment_id_seq"'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: meneame
--

ALTER TABLE ONLY entradas ALTER COLUMN id SET DEFAULT nextval('entradas_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: meneame
--

ALTER TABLE ONLY etiquetas ALTER COLUMN id SET DEFAULT nextval('etiquetas_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: meneame
--

ALTER TABLE ONLY social_account ALTER COLUMN id SET DEFAULT nextval('account_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: meneame
--

ALTER TABLE ONLY "user" ALTER COLUMN id SET DEFAULT nextval('user_id_seq'::regclass);


--
-- Name: Comment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: meneame
--

SELECT pg_catalog.setval('"Comment_id_seq"', 1, false);


--
-- Name: account_id_seq; Type: SEQUENCE SET; Schema: public; Owner: meneame
--

SELECT pg_catalog.setval('account_id_seq', 1, false);


--
-- Data for Name: categorias; Type: TABLE DATA; Schema: public; Owner: meneame
--

COPY categorias (id, nombre) FROM stdin;
1	Cultura
2	Deporte
3	Política
4	Actualidad
5	Videojuegos
\.


--
-- Name: categorias_id_seq; Type: SEQUENCE SET; Schema: public; Owner: meneame
--

SELECT pg_catalog.setval('categorias_id_seq', 5, true);


--
-- Data for Name: comment; Type: TABLE DATA; Schema: public; Owner: meneame
--

COPY comment (id, entity, "entityId", content, "parentId", level, "createdBy", "updatedBy", status, "createdAt", "updatedAt", "relatedTo", url) FROM stdin;
\.


--
-- Data for Name: entradas; Type: TABLE DATA; Schema: public; Owner: meneame
--

COPY entradas (id, url, titulo, texto, usuario_id, created_at, categoria_id) FROM stdin;
\.


--
-- Data for Name: entradas_etiquetas; Type: TABLE DATA; Schema: public; Owner: meneame
--

COPY entradas_etiquetas (entrada_id, etiqueta_id) FROM stdin;
\.


--
-- Name: entradas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: meneame
--

SELECT pg_catalog.setval('entradas_id_seq', 1, false);


--
-- Data for Name: etiquetas; Type: TABLE DATA; Schema: public; Owner: meneame
--

COPY etiquetas (id, nombre) FROM stdin;
\.


--
-- Name: etiquetas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: meneame
--

SELECT pg_catalog.setval('etiquetas_id_seq', 1, false);


--
-- Data for Name: migration; Type: TABLE DATA; Schema: public; Owner: meneame
--

COPY migration (version, apply_time) FROM stdin;
m000000_000000_base	1486738785
m010101_100001_init_comment	1486738787
m160629_121330_add_relatedTo_column_to_comment	1486738787
m161109_092304_rename_comment_table	1486738787
m161114_094902_add_url_column_to_comment_table	1486738787
m140209_132017_init	1486738788
m140403_174025_create_account_table	1486738788
m140504_113157_update_tables	1486738789
m140504_130429_create_token_table	1486738789
m140830_171933_fix_ip_field	1486738789
m140830_172703_change_account_table_name	1486738789
m141222_110026_update_ip_field	1486738789
m141222_135246_alter_username_length	1486738789
m150614_103145_update_social_account_table	1486738790
m150623_212711_fix_username_notnull	1486738790
m151218_234654_add_timezone_to_profile	1486738790
m160929_103127_add_last_login_at_to_user_table	1486738790
\.


--
-- Data for Name: profile; Type: TABLE DATA; Schema: public; Owner: meneame
--

COPY profile (user_id, name, public_email, gravatar_email, gravatar_id, location, website, bio, timezone) FROM stdin;
1000	\N	\N	\N	\N	\N	\N	\N	\N
\.


--
-- Data for Name: social_account; Type: TABLE DATA; Schema: public; Owner: meneame
--

COPY social_account (id, user_id, provider, client_id, data, code, created_at, email, username) FROM stdin;
\.


--
-- Data for Name: token; Type: TABLE DATA; Schema: public; Owner: meneame
--

COPY token (user_id, code, created_at, type) FROM stdin;
\.


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: meneame
--

COPY "user" (id, username, email, password_hash, auth_key, confirmed_at, unconfirmed_email, blocked_at, registration_ip, created_at, updated_at, flags, last_login_at) FROM stdin;
1000	prueba	prueba@gmail.com	$2y$12$BUrTQ2e7180X7rc86WK1ROWT3iFqPaIV07yi7PPMOdQq//e81s8Iu	ajKnglpo3bkx1SER-LCHY3IlLcqphiRp	1486739311	\N	\N	127.0.0.1	1486739229	1486739229	0	\N
\.


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: meneame
--

SELECT pg_catalog.setval('user_id_seq', 1, false);


--
-- Name: Comment_pkey; Type: CONSTRAINT; Schema: public; Owner: meneame
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT "Comment_pkey" PRIMARY KEY (id);


--
-- Name: account_pkey; Type: CONSTRAINT; Schema: public; Owner: meneame
--

ALTER TABLE ONLY social_account
    ADD CONSTRAINT account_pkey PRIMARY KEY (id);


--
-- Name: migration_pkey; Type: CONSTRAINT; Schema: public; Owner: meneame
--

ALTER TABLE ONLY migration
    ADD CONSTRAINT migration_pkey PRIMARY KEY (version);


--
-- Name: pk_categorias; Type: CONSTRAINT; Schema: public; Owner: meneame
--

ALTER TABLE ONLY categorias
    ADD CONSTRAINT pk_categorias PRIMARY KEY (id);


--
-- Name: pk_entradas; Type: CONSTRAINT; Schema: public; Owner: meneame
--

ALTER TABLE ONLY entradas
    ADD CONSTRAINT pk_entradas PRIMARY KEY (id);


--
-- Name: pk_etiquetas; Type: CONSTRAINT; Schema: public; Owner: meneame
--

ALTER TABLE ONLY etiquetas
    ADD CONSTRAINT pk_etiquetas PRIMARY KEY (id);


--
-- Name: profile_pkey; Type: CONSTRAINT; Schema: public; Owner: meneame
--

ALTER TABLE ONLY profile
    ADD CONSTRAINT profile_pkey PRIMARY KEY (user_id);


--
-- Name: uq_etiquetas_nombre; Type: CONSTRAINT; Schema: public; Owner: meneame
--

ALTER TABLE ONLY etiquetas
    ADD CONSTRAINT uq_etiquetas_nombre UNIQUE (nombre);


--
-- Name: user_pkey; Type: CONSTRAINT; Schema: public; Owner: meneame
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- Name: account_unique; Type: INDEX; Schema: public; Owner: meneame
--

CREATE UNIQUE INDEX account_unique ON social_account USING btree (provider, client_id);


--
-- Name: account_unique_code; Type: INDEX; Schema: public; Owner: meneame
--

CREATE UNIQUE INDEX account_unique_code ON social_account USING btree (code);


--
-- Name: idx-Comment-entity; Type: INDEX; Schema: public; Owner: meneame
--

CREATE INDEX "idx-Comment-entity" ON comment USING btree (entity);


--
-- Name: idx-Comment-status; Type: INDEX; Schema: public; Owner: meneame
--

CREATE INDEX "idx-Comment-status" ON comment USING btree (status);


--
-- Name: idx_categorias_nombre; Type: INDEX; Schema: public; Owner: meneame
--

CREATE INDEX idx_categorias_nombre ON categorias USING btree (nombre);


--
-- Name: idx_entradas_etiquetas_entrada_etiqueta; Type: INDEX; Schema: public; Owner: meneame
--

CREATE INDEX idx_entradas_etiquetas_entrada_etiqueta ON entradas_etiquetas USING btree (entrada_id, etiqueta_id);


--
-- Name: idx_entradas_etiquetas_etiqueta; Type: INDEX; Schema: public; Owner: meneame
--

CREATE INDEX idx_entradas_etiquetas_etiqueta ON entradas_etiquetas USING btree (etiqueta_id);


--
-- Name: idx_entradas_titulo; Type: INDEX; Schema: public; Owner: meneame
--

CREATE INDEX idx_entradas_titulo ON entradas USING btree (titulo);


--
-- Name: idx_etiquetas_nombre; Type: INDEX; Schema: public; Owner: meneame
--

CREATE INDEX idx_etiquetas_nombre ON etiquetas USING btree (nombre);


--
-- Name: token_unique; Type: INDEX; Schema: public; Owner: meneame
--

CREATE UNIQUE INDEX token_unique ON token USING btree (user_id, code, type);


--
-- Name: user_unique_email; Type: INDEX; Schema: public; Owner: meneame
--

CREATE UNIQUE INDEX user_unique_email ON "user" USING btree (email);


--
-- Name: user_unique_username; Type: INDEX; Schema: public; Owner: meneame
--

CREATE UNIQUE INDEX user_unique_username ON "user" USING btree (username);


--
-- Name: fk_entradas_categorias; Type: FK CONSTRAINT; Schema: public; Owner: meneame
--

ALTER TABLE ONLY entradas
    ADD CONSTRAINT fk_entradas_categorias FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON UPDATE CASCADE;


--
-- Name: fk_entradas_etiquetas_entradas; Type: FK CONSTRAINT; Schema: public; Owner: meneame
--

ALTER TABLE ONLY entradas_etiquetas
    ADD CONSTRAINT fk_entradas_etiquetas_entradas FOREIGN KEY (entrada_id) REFERENCES entradas(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: fk_entradas_etiquetas_etiquetas; Type: FK CONSTRAINT; Schema: public; Owner: meneame
--

ALTER TABLE ONLY entradas_etiquetas
    ADD CONSTRAINT fk_entradas_etiquetas_etiquetas FOREIGN KEY (etiqueta_id) REFERENCES etiquetas(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: fk_entradas_user; Type: FK CONSTRAINT; Schema: public; Owner: meneame
--

ALTER TABLE ONLY entradas
    ADD CONSTRAINT fk_entradas_user FOREIGN KEY (usuario_id) REFERENCES "user"(id) ON UPDATE CASCADE;


--
-- Name: fk_user_account; Type: FK CONSTRAINT; Schema: public; Owner: meneame
--

ALTER TABLE ONLY social_account
    ADD CONSTRAINT fk_user_account FOREIGN KEY (user_id) REFERENCES "user"(id) ON UPDATE RESTRICT ON DELETE CASCADE;


--
-- Name: fk_user_profile; Type: FK CONSTRAINT; Schema: public; Owner: meneame
--

ALTER TABLE ONLY profile
    ADD CONSTRAINT fk_user_profile FOREIGN KEY (user_id) REFERENCES "user"(id) ON UPDATE RESTRICT ON DELETE CASCADE;


--
-- Name: fk_user_token; Type: FK CONSTRAINT; Schema: public; Owner: meneame
--

ALTER TABLE ONLY token
    ADD CONSTRAINT fk_user_token FOREIGN KEY (user_id) REFERENCES "user"(id) ON UPDATE RESTRICT ON DELETE CASCADE;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--
