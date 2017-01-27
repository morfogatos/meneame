drop table if exists categorias cascade;

create table categorias (
    id      bigserial   constraint pk_categorias primary key,
    nombre  varchar(20) not null
);

insert into categorias (nombre)
    values ('Cultura'), ('Deporte'), ('Política'), ('Actualidad'), ('Videojuegos');

drop table if exists entradas cascade;

create table entradas (
    id           bigserial      constraint pk_entradas primary key,
    url          varchar(255)   not null,
    titulo       varchar(120)   not null,
    texto        varchar(550)   not null,
    usuario_id   integer        not null constraint fk_entradas_user
                                references public.user(id)
                                on delete no action on update cascade,
    created_at   timestamp with time zone not null default current_timestamp,
    categoria_id bigint         not null constraint fk_entradas_categorias
                                references categorias(id)
                                on delete no action on update cascade
);


drop table if exists etiquetas cascade;

create table etiquetas (
    id     bigserial   constraint pk_etiquetas primary key,
    nombre varchar(100) not null
);


drop table if exists entradas_etiquetas cascade;

create table entradas_etiquetas (
    entrada_id  bigint  not null constraint fk_entradas_etiquetas_entradas
                        references entradas(id)
                        on delete cascade on update cascade,
    etiqueta_id bigint  not null constraint fk_entradas_etiquetas_etiquetas
                        references etiquetas(id)
                        on delete cascade on update cascade
);

create index idx_etiquetas_nombre on etiquetas (nombre);
create index idx_categorias_nombre on categorias (nombre);
create index idx_entradas_titulo on entradas (titulo);
create index idx_entradas_etiquetas_entrada_etiqueta
    on entradas_etiquetas (entrada_id, etiqueta_id);
create index idx_entradas_etiquetas_etiqueta
    on entradas_etiquetas (etiqueta_id);
