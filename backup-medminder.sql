PGDMP                       |            db    16.1 (Debian 16.1-1.pgdg120+1)    16.1 P               0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    16384    db    DATABASE     m   CREATE DATABASE db WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'en_US.utf8';
    DROP DATABASE db;
                docker    false            �            1259    16791 
   categories    TABLE     u   CREATE TABLE public.categories (
    categoryid integer NOT NULL,
    categoryname character varying(50) NOT NULL
);
    DROP TABLE public.categories;
       public         heap    docker    false            �            1259    16790    categories_categoryid_seq    SEQUENCE     �   CREATE SEQUENCE public.categories_categoryid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.categories_categoryid_seq;
       public          docker    false    220            �           0    0    categories_categoryid_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.categories_categoryid_seq OWNED BY public.categories.categoryid;
          public          docker    false    219            �            1259    16805    medicationcategories    TABLE     �   CREATE TABLE public.medicationcategories (
    medicationid integer,
    categoryid integer,
    medicationcategoriesid integer NOT NULL
);
 (   DROP TABLE public.medicationcategories;
       public         heap    docker    false            �            1259    16777    medications    TABLE     {   CREATE TABLE public.medications (
    medicationid integer NOT NULL,
    medicationname character varying(255) NOT NULL
);
    DROP TABLE public.medications;
       public         heap    docker    false            �            1259    16936    categoriesandmedications    VIEW     -  CREATE VIEW public.categoriesandmedications AS
 SELECT c.categoryid,
    c.categoryname,
    m.medicationname
   FROM ((public.categories c
     LEFT JOIN public.medicationcategories mc ON ((c.categoryid = mc.categoryid)))
     LEFT JOIN public.medications m ON ((mc.medicationid = m.medicationid)));
 +   DROP VIEW public.categoriesandmedications;
       public          docker    false    220    218    218    220    221    221            �            1259    16852 /   medicationcategories_medicationcategoriesid_seq    SEQUENCE     �   CREATE SEQUENCE public.medicationcategories_medicationcategoriesid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 F   DROP SEQUENCE public.medicationcategories_medicationcategoriesid_seq;
       public          docker    false    221            �           0    0 /   medicationcategories_medicationcategoriesid_seq    SEQUENCE OWNED BY     �   ALTER SEQUENCE public.medicationcategories_medicationcategoriesid_seq OWNED BY public.medicationcategories.medicationcategoriesid;
          public          docker    false    226            �            1259    16776    medications_medicationid_seq    SEQUENCE     �   CREATE SEQUENCE public.medications_medicationid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.medications_medicationid_seq;
       public          docker    false    218            �           0    0    medications_medicationid_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.medications_medicationid_seq OWNED BY public.medications.medicationid;
          public          docker    false    217            �            1259    16894    medicationschedule    TABLE     �   CREATE TABLE public.medicationschedule (
    scheduleid integer NOT NULL,
    usermedicationid integer,
    dayofweek character varying(10),
    timeofday time without time zone,
    dosesperintake integer,
    uploaddate date
);
 &   DROP TABLE public.medicationschedule;
       public         heap    docker    false            �            1259    16893 !   medicationschedule_scheduleid_seq    SEQUENCE     �   CREATE SEQUENCE public.medicationschedule_scheduleid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 8   DROP SEQUENCE public.medicationschedule_scheduleid_seq;
       public          docker    false    230            �           0    0 !   medicationschedule_scheduleid_seq    SEQUENCE OWNED BY     g   ALTER SEQUENCE public.medicationschedule_scheduleid_seq OWNED BY public.medicationschedule.scheduleid;
          public          docker    false    229            �            1259    16914    notifications    TABLE     �   CREATE TABLE public.notifications (
    notificationid integer NOT NULL,
    userid integer NOT NULL,
    message text,
    "time" time without time zone,
    status boolean,
    date date,
    scheduleid integer
);
 !   DROP TABLE public.notifications;
       public         heap    docker    false            �            1259    16913     notifications_notificationid_seq    SEQUENCE     �   CREATE SEQUENCE public.notifications_notificationid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE public.notifications_notificationid_seq;
       public          docker    false    232            �           0    0     notifications_notificationid_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE public.notifications_notificationid_seq OWNED BY public.notifications.notificationid;
          public          docker    false    231            �            1259    16841    roles    TABLE     h   CREATE TABLE public.roles (
    roleid integer NOT NULL,
    rolename character varying(50) NOT NULL
);
    DROP TABLE public.roles;
       public         heap    docker    false            �            1259    16840    roles_roleid_seq    SEQUENCE     �   CREATE SEQUENCE public.roles_roleid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.roles_roleid_seq;
       public          docker    false    225            �           0    0    roles_roleid_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.roles_roleid_seq OWNED BY public.roles.roleid;
          public          docker    false    224            �            1259    16870    userdetails    TABLE     $  CREATE TABLE public.userdetails (
    userdetailsid integer NOT NULL,
    firstname character varying(255),
    lastname character varying(255),
    username character varying(255),
    photo character varying(255) DEFAULT 'default_photo.png'::character varying,
    notifications boolean
);
    DROP TABLE public.userdetails;
       public         heap    docker    false            �            1259    16869    userdetails_userdetailsid_seq    SEQUENCE     �   CREATE SEQUENCE public.userdetails_userdetailsid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.userdetails_userdetailsid_seq;
       public          docker    false    228            �           0    0    userdetails_userdetailsid_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.userdetails_userdetailsid_seq OWNED BY public.userdetails.userdetailsid;
          public          docker    false    227            �            1259    16819    usermedications    TABLE     3  CREATE TABLE public.usermedications (
    usermedicationid integer NOT NULL,
    userid integer,
    medicationid integer,
    form character varying(255) DEFAULT NULL::character varying,
    dose character varying(255) DEFAULT NULL::character varying,
    medicationname character varying(255) NOT NULL
);
 #   DROP TABLE public.usermedications;
       public         heap    docker    false            �            1259    16818 $   usermedications_usermedicationid_seq    SEQUENCE     �   CREATE SEQUENCE public.usermedications_usermedicationid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ;   DROP SEQUENCE public.usermedications_usermedicationid_seq;
       public          docker    false    223            �           0    0 $   usermedications_usermedicationid_seq    SEQUENCE OWNED BY     m   ALTER SEQUENCE public.usermedications_usermedicationid_seq OWNED BY public.usermedications.usermedicationid;
          public          docker    false    222            �            1259    16761    users    TABLE     �   CREATE TABLE public.users (
    userid integer NOT NULL,
    email character varying(255) NOT NULL,
    userdetailsid integer,
    password character varying(255) NOT NULL,
    roleid integer
);
    DROP TABLE public.users;
       public         heap    docker    false            �            1259    16760    users_userid_seq    SEQUENCE     �   CREATE SEQUENCE public.users_userid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.users_userid_seq;
       public          docker    false    216            �           0    0    users_userid_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.users_userid_seq OWNED BY public.users.userid;
          public          docker    false    215            �           2604    16794    categories categoryid    DEFAULT     ~   ALTER TABLE ONLY public.categories ALTER COLUMN categoryid SET DEFAULT nextval('public.categories_categoryid_seq'::regclass);
 D   ALTER TABLE public.categories ALTER COLUMN categoryid DROP DEFAULT;
       public          docker    false    220    219    220            �           2604    16853 +   medicationcategories medicationcategoriesid    DEFAULT     �   ALTER TABLE ONLY public.medicationcategories ALTER COLUMN medicationcategoriesid SET DEFAULT nextval('public.medicationcategories_medicationcategoriesid_seq'::regclass);
 Z   ALTER TABLE public.medicationcategories ALTER COLUMN medicationcategoriesid DROP DEFAULT;
       public          docker    false    226    221            �           2604    16780    medications medicationid    DEFAULT     �   ALTER TABLE ONLY public.medications ALTER COLUMN medicationid SET DEFAULT nextval('public.medications_medicationid_seq'::regclass);
 G   ALTER TABLE public.medications ALTER COLUMN medicationid DROP DEFAULT;
       public          docker    false    218    217    218            �           2604    16897    medicationschedule scheduleid    DEFAULT     �   ALTER TABLE ONLY public.medicationschedule ALTER COLUMN scheduleid SET DEFAULT nextval('public.medicationschedule_scheduleid_seq'::regclass);
 L   ALTER TABLE public.medicationschedule ALTER COLUMN scheduleid DROP DEFAULT;
       public          docker    false    230    229    230            �           2604    16917    notifications notificationid    DEFAULT     �   ALTER TABLE ONLY public.notifications ALTER COLUMN notificationid SET DEFAULT nextval('public.notifications_notificationid_seq'::regclass);
 K   ALTER TABLE public.notifications ALTER COLUMN notificationid DROP DEFAULT;
       public          docker    false    231    232    232            �           2604    16844    roles roleid    DEFAULT     l   ALTER TABLE ONLY public.roles ALTER COLUMN roleid SET DEFAULT nextval('public.roles_roleid_seq'::regclass);
 ;   ALTER TABLE public.roles ALTER COLUMN roleid DROP DEFAULT;
       public          docker    false    224    225    225            �           2604    16873    userdetails userdetailsid    DEFAULT     �   ALTER TABLE ONLY public.userdetails ALTER COLUMN userdetailsid SET DEFAULT nextval('public.userdetails_userdetailsid_seq'::regclass);
 H   ALTER TABLE public.userdetails ALTER COLUMN userdetailsid DROP DEFAULT;
       public          docker    false    227    228    228            �           2604    16822     usermedications usermedicationid    DEFAULT     �   ALTER TABLE ONLY public.usermedications ALTER COLUMN usermedicationid SET DEFAULT nextval('public.usermedications_usermedicationid_seq'::regclass);
 O   ALTER TABLE public.usermedications ALTER COLUMN usermedicationid DROP DEFAULT;
       public          docker    false    223    222    223            �           2604    16764    users userid    DEFAULT     l   ALTER TABLE ONLY public.users ALTER COLUMN userid SET DEFAULT nextval('public.users_userid_seq'::regclass);
 ;   ALTER TABLE public.users ALTER COLUMN userid DROP DEFAULT;
       public          docker    false    216    215    216            p          0    16791 
   categories 
   TABLE DATA                 public          docker    false    220   fa       q          0    16805    medicationcategories 
   TABLE DATA                 public          docker    false    221   
b       n          0    16777    medications 
   TABLE DATA                 public          docker    false    218   �b       z          0    16894    medicationschedule 
   TABLE DATA                 public          docker    false    230   9d       |          0    16914    notifications 
   TABLE DATA                 public          docker    false    232   e       u          0    16841    roles 
   TABLE DATA                 public          docker    false    225   �e       x          0    16870    userdetails 
   TABLE DATA                 public          docker    false    228   f       s          0    16819    usermedications 
   TABLE DATA                 public          docker    false    223   �f       l          0    16761    users 
   TABLE DATA                 public          docker    false    216   �g       �           0    0    categories_categoryid_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.categories_categoryid_seq', 7, true);
          public          docker    false    219            �           0    0 /   medicationcategories_medicationcategoriesid_seq    SEQUENCE SET     ^   SELECT pg_catalog.setval('public.medicationcategories_medicationcategoriesid_seq', 33, true);
          public          docker    false    226            �           0    0    medications_medicationid_seq    SEQUENCE SET     K   SELECT pg_catalog.setval('public.medications_medicationid_seq', 25, true);
          public          docker    false    217            �           0    0 !   medicationschedule_scheduleid_seq    SEQUENCE SET     Q   SELECT pg_catalog.setval('public.medicationschedule_scheduleid_seq', 294, true);
          public          docker    false    229            �           0    0     notifications_notificationid_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('public.notifications_notificationid_seq', 93, true);
          public          docker    false    231            �           0    0    roles_roleid_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.roles_roleid_seq', 2, true);
          public          docker    false    224            �           0    0    userdetails_userdetailsid_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.userdetails_userdetailsid_seq', 32, true);
          public          docker    false    227            �           0    0 $   usermedications_usermedicationid_seq    SEQUENCE SET     T   SELECT pg_catalog.setval('public.usermedications_usermedicationid_seq', 188, true);
          public          docker    false    222            �           0    0    users_userid_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.users_userid_seq', 26, true);
          public          docker    false    215            �           2606    16796    categories categories_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (categoryid);
 D   ALTER TABLE ONLY public.categories DROP CONSTRAINT categories_pkey;
       public            docker    false    220            �           2606    16855 .   medicationcategories medicationcategories_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.medicationcategories
    ADD CONSTRAINT medicationcategories_pkey PRIMARY KEY (medicationcategoriesid);
 X   ALTER TABLE ONLY public.medicationcategories DROP CONSTRAINT medicationcategories_pkey;
       public            docker    false    221            �           2606    16782    medications medications_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.medications
    ADD CONSTRAINT medications_pkey PRIMARY KEY (medicationid);
 F   ALTER TABLE ONLY public.medications DROP CONSTRAINT medications_pkey;
       public            docker    false    218            �           2606    16899 *   medicationschedule medicationschedule_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public.medicationschedule
    ADD CONSTRAINT medicationschedule_pkey PRIMARY KEY (scheduleid);
 T   ALTER TABLE ONLY public.medicationschedule DROP CONSTRAINT medicationschedule_pkey;
       public            docker    false    230            �           2606    16921     notifications notifications_pkey 
   CONSTRAINT     j   ALTER TABLE ONLY public.notifications
    ADD CONSTRAINT notifications_pkey PRIMARY KEY (notificationid);
 J   ALTER TABLE ONLY public.notifications DROP CONSTRAINT notifications_pkey;
       public            docker    false    232            �           2606    16846    roles roles_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (roleid);
 :   ALTER TABLE ONLY public.roles DROP CONSTRAINT roles_pkey;
       public            docker    false    225            �           2606    16877    userdetails userdetails_pkey 
   CONSTRAINT     e   ALTER TABLE ONLY public.userdetails
    ADD CONSTRAINT userdetails_pkey PRIMARY KEY (userdetailsid);
 F   ALTER TABLE ONLY public.userdetails DROP CONSTRAINT userdetails_pkey;
       public            docker    false    228            �           2606    16885 $   userdetails userdetails_username_key 
   CONSTRAINT     c   ALTER TABLE ONLY public.userdetails
    ADD CONSTRAINT userdetails_username_key UNIQUE (username);
 N   ALTER TABLE ONLY public.userdetails DROP CONSTRAINT userdetails_username_key;
       public            docker    false    228            �           2606    16829 $   usermedications usermedications_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public.usermedications
    ADD CONSTRAINT usermedications_pkey PRIMARY KEY (usermedicationid);
 N   ALTER TABLE ONLY public.usermedications DROP CONSTRAINT usermedications_pkey;
       public            docker    false    223            �           2606    16766    users users_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (userid);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            docker    false    216            �           2606    16768    users users_userdetailsid_key 
   CONSTRAINT     a   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_userdetailsid_key UNIQUE (userdetailsid);
 G   ALTER TABLE ONLY public.users DROP CONSTRAINT users_userdetailsid_key;
       public            docker    false    216            �           1259    16911    schedule_unique    INDEX     �   CREATE UNIQUE INDEX schedule_unique ON public.medicationschedule USING btree (usermedicationid, dayofweek, timeofday, dosesperintake);
 #   DROP INDEX public.schedule_unique;
       public            docker    false    230    230    230    230            �           2606    16879    users fk_userdetails    FK CONSTRAINT     �   ALTER TABLE ONLY public.users
    ADD CONSTRAINT fk_userdetails FOREIGN KEY (userdetailsid) REFERENCES public.userdetails(userdetailsid) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 >   ALTER TABLE ONLY public.users DROP CONSTRAINT fk_userdetails;
       public          docker    false    3274    228    216            �           2606    16847    users fk_users_roles    FK CONSTRAINT     v   ALTER TABLE ONLY public.users
    ADD CONSTRAINT fk_users_roles FOREIGN KEY (roleid) REFERENCES public.roles(roleid);
 >   ALTER TABLE ONLY public.users DROP CONSTRAINT fk_users_roles;
       public          docker    false    3272    216    225            �           2606    16813 9   medicationcategories medicationcategories_categoryid_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.medicationcategories
    ADD CONSTRAINT medicationcategories_categoryid_fkey FOREIGN KEY (categoryid) REFERENCES public.categories(categoryid);
 c   ALTER TABLE ONLY public.medicationcategories DROP CONSTRAINT medicationcategories_categoryid_fkey;
       public          docker    false    221    3266    220            �           2606    16808 ;   medicationcategories medicationcategories_medicationid_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.medicationcategories
    ADD CONSTRAINT medicationcategories_medicationid_fkey FOREIGN KEY (medicationid) REFERENCES public.medications(medicationid);
 e   ALTER TABLE ONLY public.medicationcategories DROP CONSTRAINT medicationcategories_medicationid_fkey;
       public          docker    false    218    221    3264            �           2606    16940 '   notifications medicationscheduleid_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.notifications
    ADD CONSTRAINT medicationscheduleid_fkey FOREIGN KEY (scheduleid) REFERENCES public.medicationschedule(scheduleid) ON DELETE SET NULL;
 Q   ALTER TABLE ONLY public.notifications DROP CONSTRAINT medicationscheduleid_fkey;
       public          docker    false    232    230    3278            �           2606    16922 '   notifications notifications_userid_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.notifications
    ADD CONSTRAINT notifications_userid_fkey FOREIGN KEY (userid) REFERENCES public.users(userid);
 Q   ALTER TABLE ONLY public.notifications DROP CONSTRAINT notifications_userid_fkey;
       public          docker    false    216    3260    232            �           2606    16905 '   medicationschedule usermedications_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.medicationschedule
    ADD CONSTRAINT usermedications_fkey FOREIGN KEY (usermedicationid) REFERENCES public.usermedications(usermedicationid) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 Q   ALTER TABLE ONLY public.medicationschedule DROP CONSTRAINT usermedications_fkey;
       public          docker    false    223    3270    230            �           2606    16835 1   usermedications usermedications_medicationid_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.usermedications
    ADD CONSTRAINT usermedications_medicationid_fkey FOREIGN KEY (medicationid) REFERENCES public.medications(medicationid);
 [   ALTER TABLE ONLY public.usermedications DROP CONSTRAINT usermedications_medicationid_fkey;
       public          docker    false    218    223    3264            �           2606    16830 +   usermedications usermedications_userid_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.usermedications
    ADD CONSTRAINT usermedications_userid_fkey FOREIGN KEY (userid) REFERENCES public.users(userid);
 U   ALTER TABLE ONLY public.usermedications DROP CONSTRAINT usermedications_userid_fkey;
       public          docker    false    216    223    3260            p   �   x���K
�0@�yV�YT�?pT���Ti����A>%�BwoY@��ý�n�����t�����ocQ8�(/������7@M!Q��u��DX��[j�K�/	J�7v���ć�
�|Bx����}��h��	�\G��1J�?
�!�-&~�      q   �   x����
�0��}�D���OzH[�k[$�V�y��'p`��#��������M�7�����}B���!�x�^a|��vw�[����q�M��$9�@�H�؝2@�H� �E�H9K�t
��n��\b �M�PQZ*�H�$}�"Z)U�=��H�I��=�}��"�'�,��b0#Q�,�Q�,�Ɗ�8���ȞY딑=3�^�i�F�"���-�SN��M�p�      n   ,  x����N� F��)z��#�����D���5'���t��2��kr��7g��f�/�z�-|j����*c�Y�~l��H��
Jۨzt��U�?Rf�j��ف��g�=�P��U�lb]v��GЎ2*� �(e�Ѐ��2���و9�c�y��/:�+�v	�hp�E���> ��4&q��w���d�_G���;�0&�CI��|���3LA�4ʵ���zr)�Y�E!�u�G����D/�3�d�v:h4��R,��6�ᭉ$J*�޷C�'cs��aJ�`�`ƥ�������      z   �   x���O�0��~��V��w�ϴSB���t�`�}�6HA$����<{�Eq�R��=䭮��]U�U��y)
Yt���a�Vԧ&�ڦȞXM����fPWJ�m�(��ֈ~�3���*�F�o����� �p&�ٍ�����r	h����|�Ü�R�'����i)��o�����f{
��N�K|��0^m5ө      |   �   x���v
Q���W((M��L���/�L�LN,���+Vs�	uVа4�Q02�QP�,QW/V04�24UTI�NU�L*�UʀŬ�쒢�T�����������!P���\Ӛ˓h��ZL�-46�Z�X���Z������� boZbN1�Ŗ&@��� R|>d      u   D   x���v
Q���W((M��L�+��I-Vs�	uV�0�QPOL���S״��$�����8���� ,�      x   �   x���v
Q���W((M��L�+-N-JI-I��)Vs�	uV�06�QP�J�SR�)�����U NbJn&X�<?'M� /�.)*Mմ��$�h�љ 3|J�ATJbQvZ~Qjq	����X�S_��_�O���ǃ0Hv'sq :~S[      s   �   x��ѽ�0����&��#J���@�Ht�`1M
m�2���uP�`�ݾ�s�yt-P�����z�K,Z� 5(�:�naRF9�8�c!׷PZ&��LN(5����x�o��Ɉ����9wр �b��)_�����	&9,G�=���b5b�'�+���.V�d秽63Pc�
��Qo>i(9Y��Q��o�55@�+F���I'��(���      l     x����n�@E�>��L`�t#P���*�)�0q	���/$5.��]��=��w��:0�{𘢹��Beń�l���.�E��z3��t�d8a,簟s������+,dݵ�픏&VAR��q����<�,QeaX������������4U�)~�+�I'�h��~?���hGlK��يD�7n�|ݩ]k���-��E7��ә����d�H�����ɰ3	��e�}�I�p=f���"�[B��.����w||a6�}�u*     