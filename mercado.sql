PGDMP     )                
    {            mercado #   14.9 (Ubuntu 14.9-0ubuntu0.22.04.1) #   14.9 (Ubuntu 14.9-0ubuntu0.22.04.1)     /           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            0           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            1           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            2           1262    16384    mercado    DATABASE     \   CREATE DATABASE mercado WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'pt_BR.UTF-8';
    DROP DATABASE mercado;
                postgres    false                        2615    16394    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
                postgres    false            3           0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                   postgres    false    3            �            1259    16395    produto    TABLE     �   CREATE TABLE public.produto (
    id_produto integer NOT NULL,
    descricao character varying NOT NULL,
    valor real NOT NULL,
    id_tipo_produto integer NOT NULL
);
    DROP TABLE public.produto;
       public         heap    postgres    false    3            �            1259    16400    produto_id_produto_seq    SEQUENCE     �   ALTER TABLE public.produto ALTER COLUMN id_produto ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.produto_id_produto_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    3    209            �            1259    16451    tipo_produto    TABLE     �   CREATE TABLE public.tipo_produto (
    id_tipo_produto integer NOT NULL,
    nome character varying NOT NULL,
    imposto real NOT NULL
);
     DROP TABLE public.tipo_produto;
       public         heap    postgres    false    3            �            1259    16450     tipo_produto_id_tipo_produto_seq    SEQUENCE     �   ALTER TABLE public.tipo_produto ALTER COLUMN id_tipo_produto ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.tipo_produto_id_tipo_produto_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    3    214            �            1259    16407    venda    TABLE     �  CREATE TABLE public.venda (
    id_produto integer NOT NULL,
    valor_unitario real NOT NULL,
    imposto real NOT NULL,
    valor_total real NOT NULL,
    id_venda integer NOT NULL,
    cliente character varying,
    descricao character varying NOT NULL,
    quantidade integer NOT NULL,
    pedido integer,
    data information_schema.time_stamp,
    totalimpostos real,
    totalvenda real,
    totalimpostounitario real
);
    DROP TABLE public.venda;
       public         heap    postgres    false    3            �            1259    16426    venda_id_venda_seq    SEQUENCE     �   ALTER TABLE public.venda ALTER COLUMN id_venda ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.venda_id_venda_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    211    3            '          0    16395    produto 
   TABLE DATA           P   COPY public.produto (id_produto, descricao, valor, id_tipo_produto) FROM stdin;
    public          postgres    false    209   '       ,          0    16451    tipo_produto 
   TABLE DATA           F   COPY public.tipo_produto (id_tipo_produto, nome, imposto) FROM stdin;
    public          postgres    false    214   D       )          0    16407    venda 
   TABLE DATA           �   COPY public.venda (id_produto, valor_unitario, imposto, valor_total, id_venda, cliente, descricao, quantidade, pedido, data, totalimpostos, totalvenda, totalimpostounitario) FROM stdin;
    public          postgres    false    211   a       4           0    0    produto_id_produto_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.produto_id_produto_seq', 29, true);
          public          postgres    false    210            5           0    0     tipo_produto_id_tipo_produto_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('public.tipo_produto_id_tipo_produto_seq', 24, true);
          public          postgres    false    213            6           0    0    venda_id_venda_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.venda_id_venda_seq', 98, true);
          public          postgres    false    212            �           2606    16402    produto produto_pk 
   CONSTRAINT     X   ALTER TABLE ONLY public.produto
    ADD CONSTRAINT produto_pk PRIMARY KEY (id_produto);
 <   ALTER TABLE ONLY public.produto DROP CONSTRAINT produto_pk;
       public            postgres    false    209            �           2606    16457    tipo_produto tipo_produto_pk 
   CONSTRAINT     g   ALTER TABLE ONLY public.tipo_produto
    ADD CONSTRAINT tipo_produto_pk PRIMARY KEY (id_tipo_produto);
 F   ALTER TABLE ONLY public.tipo_produto DROP CONSTRAINT tipo_produto_pk;
       public            postgres    false    214            �           2606    16443    venda venda_pk 
   CONSTRAINT     R   ALTER TABLE ONLY public.venda
    ADD CONSTRAINT venda_pk PRIMARY KEY (id_venda);
 8   ALTER TABLE ONLY public.venda DROP CONSTRAINT venda_pk;
       public            postgres    false    211            �           1259    16403    produto_id_produto_idx    INDEX     P   CREATE INDEX produto_id_produto_idx ON public.produto USING btree (id_produto);
 *   DROP INDEX public.produto_id_produto_idx;
       public            postgres    false    209            �           2606    16458    produto produto_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.produto
    ADD CONSTRAINT produto_fk FOREIGN KEY (id_tipo_produto) REFERENCES public.tipo_produto(id_tipo_produto);
 <   ALTER TABLE ONLY public.produto DROP CONSTRAINT produto_fk;
       public          postgres    false    209    214    3225            �           2606    16465    venda venda_fk    FK CONSTRAINT     z   ALTER TABLE ONLY public.venda
    ADD CONSTRAINT venda_fk FOREIGN KEY (id_produto) REFERENCES public.produto(id_produto);
 8   ALTER TABLE ONLY public.venda DROP CONSTRAINT venda_fk;
       public          postgres    false    209    3221    211            '      x������ � �      ,      x������ � �      )      x������ � �     