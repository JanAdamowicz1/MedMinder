--
-- PostgreSQL database dump
--

-- Dumped from database version 16.1 (Debian 16.1-1.pgdg120+1)
-- Dumped by pg_dump version 16.1

-- Started on 2024-01-21 12:28:39 UTC

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 220 (class 1259 OID 16791)
-- Name: categories; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.categories (
    categoryid integer NOT NULL,
    categoryname character varying(50) NOT NULL
);


ALTER TABLE public.categories OWNER TO docker;

--
-- TOC entry 219 (class 1259 OID 16790)
-- Name: categories_categoryid_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.categories_categoryid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.categories_categoryid_seq OWNER TO docker;

--
-- TOC entry 3458 (class 0 OID 0)
-- Dependencies: 219
-- Name: categories_categoryid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.categories_categoryid_seq OWNED BY public.categories.categoryid;


--
-- TOC entry 221 (class 1259 OID 16805)
-- Name: medicationcategories; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.medicationcategories (
    medicationid integer,
    categoryid integer,
    medicationcategoriesid integer NOT NULL
);


ALTER TABLE public.medicationcategories OWNER TO docker;

--
-- TOC entry 218 (class 1259 OID 16777)
-- Name: medications; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.medications (
    medicationid integer NOT NULL,
    medicationname character varying(255) NOT NULL
);


ALTER TABLE public.medications OWNER TO docker;

--
-- TOC entry 233 (class 1259 OID 16936)
-- Name: categoriesandmedications; Type: VIEW; Schema: public; Owner: docker
--

CREATE VIEW public.categoriesandmedications AS
 SELECT c.categoryid,
    c.categoryname,
    m.medicationname
   FROM ((public.categories c
     LEFT JOIN public.medicationcategories mc ON ((c.categoryid = mc.categoryid)))
     LEFT JOIN public.medications m ON ((mc.medicationid = m.medicationid)));


ALTER VIEW public.categoriesandmedications OWNER TO docker;

--
-- TOC entry 226 (class 1259 OID 16852)
-- Name: medicationcategories_medicationcategoriesid_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.medicationcategories_medicationcategoriesid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.medicationcategories_medicationcategoriesid_seq OWNER TO docker;

--
-- TOC entry 3459 (class 0 OID 0)
-- Dependencies: 226
-- Name: medicationcategories_medicationcategoriesid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.medicationcategories_medicationcategoriesid_seq OWNED BY public.medicationcategories.medicationcategoriesid;


--
-- TOC entry 217 (class 1259 OID 16776)
-- Name: medications_medicationid_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.medications_medicationid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.medications_medicationid_seq OWNER TO docker;

--
-- TOC entry 3460 (class 0 OID 0)
-- Dependencies: 217
-- Name: medications_medicationid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.medications_medicationid_seq OWNED BY public.medications.medicationid;


--
-- TOC entry 230 (class 1259 OID 16894)
-- Name: medicationschedule; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.medicationschedule (
    scheduleid integer NOT NULL,
    usermedicationid integer,
    dayofweek character varying(10),
    timeofday time without time zone,
    dosesperintake integer,
    uploaddate date
);


ALTER TABLE public.medicationschedule OWNER TO docker;

--
-- TOC entry 229 (class 1259 OID 16893)
-- Name: medicationschedule_scheduleid_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.medicationschedule_scheduleid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.medicationschedule_scheduleid_seq OWNER TO docker;

--
-- TOC entry 3461 (class 0 OID 0)
-- Dependencies: 229
-- Name: medicationschedule_scheduleid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.medicationschedule_scheduleid_seq OWNED BY public.medicationschedule.scheduleid;


--
-- TOC entry 232 (class 1259 OID 16914)
-- Name: notifications; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.notifications (
    notificationid integer NOT NULL,
    userid integer NOT NULL,
    message text,
    "time" time without time zone,
    status boolean,
    date date,
    scheduleid integer
);


ALTER TABLE public.notifications OWNER TO docker;

--
-- TOC entry 231 (class 1259 OID 16913)
-- Name: notifications_notificationid_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.notifications_notificationid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.notifications_notificationid_seq OWNER TO docker;

--
-- TOC entry 3462 (class 0 OID 0)
-- Dependencies: 231
-- Name: notifications_notificationid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.notifications_notificationid_seq OWNED BY public.notifications.notificationid;


--
-- TOC entry 225 (class 1259 OID 16841)
-- Name: roles; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.roles (
    roleid integer NOT NULL,
    rolename character varying(50) NOT NULL
);


ALTER TABLE public.roles OWNER TO docker;

--
-- TOC entry 224 (class 1259 OID 16840)
-- Name: roles_roleid_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.roles_roleid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.roles_roleid_seq OWNER TO docker;

--
-- TOC entry 3463 (class 0 OID 0)
-- Dependencies: 224
-- Name: roles_roleid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.roles_roleid_seq OWNED BY public.roles.roleid;


--
-- TOC entry 228 (class 1259 OID 16870)
-- Name: userdetails; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.userdetails (
    userdetailsid integer NOT NULL,
    firstname character varying(255),
    lastname character varying(255),
    username character varying(255),
    photo character varying(255) DEFAULT 'default_photo.png'::character varying,
    notifications boolean
);


ALTER TABLE public.userdetails OWNER TO docker;

--
-- TOC entry 227 (class 1259 OID 16869)
-- Name: userdetails_userdetailsid_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.userdetails_userdetailsid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.userdetails_userdetailsid_seq OWNER TO docker;

--
-- TOC entry 3464 (class 0 OID 0)
-- Dependencies: 227
-- Name: userdetails_userdetailsid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.userdetails_userdetailsid_seq OWNED BY public.userdetails.userdetailsid;


--
-- TOC entry 223 (class 1259 OID 16819)
-- Name: usermedications; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.usermedications (
    usermedicationid integer NOT NULL,
    userid integer,
    medicationid integer,
    form character varying(255) DEFAULT NULL::character varying,
    dose character varying(255) DEFAULT NULL::character varying,
    medicationname character varying(255) NOT NULL
);


ALTER TABLE public.usermedications OWNER TO docker;

--
-- TOC entry 222 (class 1259 OID 16818)
-- Name: usermedications_usermedicationid_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.usermedications_usermedicationid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.usermedications_usermedicationid_seq OWNER TO docker;

--
-- TOC entry 3465 (class 0 OID 0)
-- Dependencies: 222
-- Name: usermedications_usermedicationid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.usermedications_usermedicationid_seq OWNED BY public.usermedications.usermedicationid;


--
-- TOC entry 216 (class 1259 OID 16761)
-- Name: users; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.users (
    userid integer NOT NULL,
    email character varying(255) NOT NULL,
    userdetailsid integer,
    password character varying(255) NOT NULL,
    roleid integer
);


ALTER TABLE public.users OWNER TO docker;

--
-- TOC entry 215 (class 1259 OID 16760)
-- Name: users_userid_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.users_userid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_userid_seq OWNER TO docker;

--
-- TOC entry 3466 (class 0 OID 0)
-- Dependencies: 215
-- Name: users_userid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.users_userid_seq OWNED BY public.users.userid;


--
-- TOC entry 3249 (class 2604 OID 16794)
-- Name: categories categoryid; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.categories ALTER COLUMN categoryid SET DEFAULT nextval('public.categories_categoryid_seq'::regclass);


--
-- TOC entry 3250 (class 2604 OID 16853)
-- Name: medicationcategories medicationcategoriesid; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.medicationcategories ALTER COLUMN medicationcategoriesid SET DEFAULT nextval('public.medicationcategories_medicationcategoriesid_seq'::regclass);


--
-- TOC entry 3248 (class 2604 OID 16780)
-- Name: medications medicationid; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.medications ALTER COLUMN medicationid SET DEFAULT nextval('public.medications_medicationid_seq'::regclass);


--
-- TOC entry 3257 (class 2604 OID 16897)
-- Name: medicationschedule scheduleid; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.medicationschedule ALTER COLUMN scheduleid SET DEFAULT nextval('public.medicationschedule_scheduleid_seq'::regclass);


--
-- TOC entry 3258 (class 2604 OID 16917)
-- Name: notifications notificationid; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.notifications ALTER COLUMN notificationid SET DEFAULT nextval('public.notifications_notificationid_seq'::regclass);


--
-- TOC entry 3254 (class 2604 OID 16844)
-- Name: roles roleid; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.roles ALTER COLUMN roleid SET DEFAULT nextval('public.roles_roleid_seq'::regclass);


--
-- TOC entry 3255 (class 2604 OID 16873)
-- Name: userdetails userdetailsid; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.userdetails ALTER COLUMN userdetailsid SET DEFAULT nextval('public.userdetails_userdetailsid_seq'::regclass);


--
-- TOC entry 3251 (class 2604 OID 16822)
-- Name: usermedications usermedicationid; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.usermedications ALTER COLUMN usermedicationid SET DEFAULT nextval('public.usermedications_usermedicationid_seq'::regclass);


--
-- TOC entry 3247 (class 2604 OID 16764)
-- Name: users userid; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.users ALTER COLUMN userid SET DEFAULT nextval('public.users_userid_seq'::regclass);


--
-- TOC entry 3440 (class 0 OID 16791)
-- Dependencies: 220
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: docker
--

INSERT INTO public.categories VALUES (1, 'Pain Relievers');
INSERT INTO public.categories VALUES (2, 'Anti-inflammatory');
INSERT INTO public.categories VALUES (3, 'Antipyretics');
INSERT INTO public.categories VALUES (4, 'Cardiac');
INSERT INTO public.categories VALUES (5, 'Antibiotics');
INSERT INTO public.categories VALUES (6, 'Antidiabetic');
INSERT INTO public.categories VALUES (7, 'Asthma');


--
-- TOC entry 3441 (class 0 OID 16805)
-- Dependencies: 221
-- Data for Name: medicationcategories; Type: TABLE DATA; Schema: public; Owner: docker
--

INSERT INTO public.medicationcategories VALUES (1, 1, 4);
INSERT INTO public.medicationcategories VALUES (2, 1, 5);
INSERT INTO public.medicationcategories VALUES (3, 1, 6);
INSERT INTO public.medicationcategories VALUES (2, 2, 7);
INSERT INTO public.medicationcategories VALUES (4, 2, 8);
INSERT INTO public.medicationcategories VALUES (5, 2, 9);
INSERT INTO public.medicationcategories VALUES (1, 3, 1);
INSERT INTO public.medicationcategories VALUES (2, 3, 2);
INSERT INTO public.medicationcategories VALUES (3, 3, 3);
INSERT INTO public.medicationcategories VALUES (6, 4, 10);
INSERT INTO public.medicationcategories VALUES (7, 4, 11);
INSERT INTO public.medicationcategories VALUES (8, 4, 12);
INSERT INTO public.medicationcategories VALUES (9, 5, 13);
INSERT INTO public.medicationcategories VALUES (10, 5, 14);
INSERT INTO public.medicationcategories VALUES (11, 5, 15);
INSERT INTO public.medicationcategories VALUES (12, 6, 16);
INSERT INTO public.medicationcategories VALUES (13, 6, 17);
INSERT INTO public.medicationcategories VALUES (14, 6, 18);
INSERT INTO public.medicationcategories VALUES (15, 7, 22);
INSERT INTO public.medicationcategories VALUES (16, 7, 23);
INSERT INTO public.medicationcategories VALUES (17, 7, 24);
INSERT INTO public.medicationcategories VALUES (18, 4, 25);
INSERT INTO public.medicationcategories VALUES (20, 1, 27);
INSERT INTO public.medicationcategories VALUES (21, 1, 28);
INSERT INTO public.medicationcategories VALUES (22, 7, 29);
INSERT INTO public.medicationcategories VALUES (23, 7, 30);
INSERT INTO public.medicationcategories VALUES (24, 2, 31);
INSERT INTO public.medicationcategories VALUES (24, 7, 33);


--
-- TOC entry 3438 (class 0 OID 16777)
-- Dependencies: 218
-- Data for Name: medications; Type: TABLE DATA; Schema: public; Owner: docker
--

INSERT INTO public.medications VALUES (1, 'Paracetamol');
INSERT INTO public.medications VALUES (2, 'Ibuprofen');
INSERT INTO public.medications VALUES (3, 'Aspirin');
INSERT INTO public.medications VALUES (4, 'Naproxen');
INSERT INTO public.medications VALUES (5, 'Diclofenac');
INSERT INTO public.medications VALUES (6, 'Amlodipine');
INSERT INTO public.medications VALUES (7, 'Metoprolol');
INSERT INTO public.medications VALUES (8, 'Warfarin');
INSERT INTO public.medications VALUES (9, 'Amoxicillin');
INSERT INTO public.medications VALUES (10, 'Ciprofloxacin');
INSERT INTO public.medications VALUES (11, 'Azithromycin');
INSERT INTO public.medications VALUES (12, 'Metformin');
INSERT INTO public.medications VALUES (13, 'Insulin');
INSERT INTO public.medications VALUES (14, 'Gliclazide');
INSERT INTO public.medications VALUES (15, 'Salbutamol');
INSERT INTO public.medications VALUES (16, 'Fluticasone');
INSERT INTO public.medications VALUES (17, 'Montelukast');
INSERT INTO public.medications VALUES (18, 'Heparin');
INSERT INTO public.medications VALUES (20, 'Oxycodone');
INSERT INTO public.medications VALUES (21, 'Meperidine');
INSERT INTO public.medications VALUES (22, 'Albuterol');
INSERT INTO public.medications VALUES (23, 'Budesonide');
INSERT INTO public.medications VALUES (24, 'Prednizon');


--
-- TOC entry 3450 (class 0 OID 16894)
-- Dependencies: 230
-- Data for Name: medicationschedule; Type: TABLE DATA; Schema: public; Owner: docker
--

INSERT INTO public.medicationschedule VALUES (292, 186, 'Monday', '08:00:00', 1, '2024-01-21');
INSERT INTO public.medicationschedule VALUES (293, 187, 'Wednesday', '16:00:00', 2, '2024-01-21');
INSERT INTO public.medicationschedule VALUES (291, 185, 'Saturday', '13:00:00', 2, '2024-01-21');
INSERT INTO public.medicationschedule VALUES (294, 188, 'Sunday', '12:30:00', 2, '2024-01-21');
INSERT INTO public.medicationschedule VALUES (287, 181, 'Sunday', '12:15:00', 2, '2024-01-21');
INSERT INTO public.medicationschedule VALUES (290, 184, 'Thursday', '17:00:00', 2, '2024-01-21');
INSERT INTO public.medicationschedule VALUES (289, 183, 'Wednesday', '14:30:00', 1, '2024-01-21');
INSERT INTO public.medicationschedule VALUES (288, 182, 'Thursday', '13:00:00', 2, '2024-01-21');


--
-- TOC entry 3452 (class 0 OID 16914)
-- Dependencies: 232
-- Data for Name: notifications; Type: TABLE DATA; Schema: public; Owner: docker
--

INSERT INTO public.notifications VALUES (92, 25, 'It''s 12:15! Take Ibum', '12:15:00', true, '2024-01-21', 287);
INSERT INTO public.notifications VALUES (93, 24, 'It''s 12:30! Take Paracetamol', '12:30:00', false, '2024-01-21', 294);


--
-- TOC entry 3445 (class 0 OID 16841)
-- Dependencies: 225
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: docker
--

INSERT INTO public.roles VALUES (1, 'admin');
INSERT INTO public.roles VALUES (2, 'user');


--
-- TOC entry 3448 (class 0 OID 16870)
-- Dependencies: 228
-- Data for Name: userdetails; Type: TABLE DATA; Schema: public; Owner: docker
--

INSERT INTO public.userdetails VALUES (31, 'Jan', 'Adamowicz', 'admin', 'wolf.png', true);
INSERT INTO public.userdetails VALUES (30, 'Ji', 'Luo', 'darkforest', 'default_photo.png', true);
INSERT INTO public.userdetails VALUES (15, 'Jan', '', 'user', 'wolf.png', true);


--
-- TOC entry 3443 (class 0 OID 16819)
-- Dependencies: 223
-- Data for Name: usermedications; Type: TABLE DATA; Schema: public; Owner: docker
--

INSERT INTO public.usermedications VALUES (181, 25, NULL, 'pill', '100', 'Ibum');
INSERT INTO public.usermedications VALUES (182, 25, 8, 'pill', '100', 'Warfarin');
INSERT INTO public.usermedications VALUES (183, 25, NULL, 'syrup', '35', 'Prospan');
INSERT INTO public.usermedications VALUES (184, 25, 7, 'tablet', '50', 'Metoprolol');
INSERT INTO public.usermedications VALUES (185, 24, 1, 'pill', '50', 'Paracetamol');
INSERT INTO public.usermedications VALUES (186, 24, 3, 'pill', '100', 'Aspirin');
INSERT INTO public.usermedications VALUES (187, 24, NULL, 'pill', '500', 'Efferalgan');
INSERT INTO public.usermedications VALUES (188, 24, 1, 'pill', '100', 'Paracetamol');


--
-- TOC entry 3436 (class 0 OID 16761)
-- Dependencies: 216
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: docker
--

INSERT INTO public.users VALUES (10, 'test@test.com', 15, '$2y$10$mnuoZG43i5hwfyOACeHAFucB.dpQzYz76yP8Xv4lwK7B02VrgpMBG', 1);
INSERT INTO public.users VALUES (24, 'user@user.com', 30, '$2y$10$ld7Kk4HiDZJnKMCYiL8g9.4neLANUXhxivyn6wBwvJv.uGKeUVIbC', 2);
INSERT INTO public.users VALUES (25, 'adm.medminder@gmail.com', 31, '$2y$10$7lz6Vh82vVKJtyXC8L5fVO92hXQNZXUr.IA72kdlIbHU9lMQcw1YG', 1);


--
-- TOC entry 3467 (class 0 OID 0)
-- Dependencies: 219
-- Name: categories_categoryid_seq; Type: SEQUENCE SET; Schema: public; Owner: docker
--

SELECT pg_catalog.setval('public.categories_categoryid_seq', 7, true);


--
-- TOC entry 3468 (class 0 OID 0)
-- Dependencies: 226
-- Name: medicationcategories_medicationcategoriesid_seq; Type: SEQUENCE SET; Schema: public; Owner: docker
--

SELECT pg_catalog.setval('public.medicationcategories_medicationcategoriesid_seq', 33, true);


--
-- TOC entry 3469 (class 0 OID 0)
-- Dependencies: 217
-- Name: medications_medicationid_seq; Type: SEQUENCE SET; Schema: public; Owner: docker
--

SELECT pg_catalog.setval('public.medications_medicationid_seq', 25, true);


--
-- TOC entry 3470 (class 0 OID 0)
-- Dependencies: 229
-- Name: medicationschedule_scheduleid_seq; Type: SEQUENCE SET; Schema: public; Owner: docker
--

SELECT pg_catalog.setval('public.medicationschedule_scheduleid_seq', 294, true);


--
-- TOC entry 3471 (class 0 OID 0)
-- Dependencies: 231
-- Name: notifications_notificationid_seq; Type: SEQUENCE SET; Schema: public; Owner: docker
--

SELECT pg_catalog.setval('public.notifications_notificationid_seq', 93, true);


--
-- TOC entry 3472 (class 0 OID 0)
-- Dependencies: 224
-- Name: roles_roleid_seq; Type: SEQUENCE SET; Schema: public; Owner: docker
--

SELECT pg_catalog.setval('public.roles_roleid_seq', 2, true);


--
-- TOC entry 3473 (class 0 OID 0)
-- Dependencies: 227
-- Name: userdetails_userdetailsid_seq; Type: SEQUENCE SET; Schema: public; Owner: docker
--

SELECT pg_catalog.setval('public.userdetails_userdetailsid_seq', 32, true);


--
-- TOC entry 3474 (class 0 OID 0)
-- Dependencies: 222
-- Name: usermedications_usermedicationid_seq; Type: SEQUENCE SET; Schema: public; Owner: docker
--

SELECT pg_catalog.setval('public.usermedications_usermedicationid_seq', 188, true);


--
-- TOC entry 3475 (class 0 OID 0)
-- Dependencies: 215
-- Name: users_userid_seq; Type: SEQUENCE SET; Schema: public; Owner: docker
--

SELECT pg_catalog.setval('public.users_userid_seq', 26, true);


--
-- TOC entry 3266 (class 2606 OID 16796)
-- Name: categories categories_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (categoryid);


--
-- TOC entry 3268 (class 2606 OID 16855)
-- Name: medicationcategories medicationcategories_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.medicationcategories
    ADD CONSTRAINT medicationcategories_pkey PRIMARY KEY (medicationcategoriesid);


--
-- TOC entry 3264 (class 2606 OID 16782)
-- Name: medications medications_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.medications
    ADD CONSTRAINT medications_pkey PRIMARY KEY (medicationid);


--
-- TOC entry 3278 (class 2606 OID 16899)
-- Name: medicationschedule medicationschedule_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.medicationschedule
    ADD CONSTRAINT medicationschedule_pkey PRIMARY KEY (scheduleid);


--
-- TOC entry 3281 (class 2606 OID 16921)
-- Name: notifications notifications_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.notifications
    ADD CONSTRAINT notifications_pkey PRIMARY KEY (notificationid);


--
-- TOC entry 3272 (class 2606 OID 16846)
-- Name: roles roles_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (roleid);


--
-- TOC entry 3274 (class 2606 OID 16877)
-- Name: userdetails userdetails_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.userdetails
    ADD CONSTRAINT userdetails_pkey PRIMARY KEY (userdetailsid);


--
-- TOC entry 3276 (class 2606 OID 16885)
-- Name: userdetails userdetails_username_key; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.userdetails
    ADD CONSTRAINT userdetails_username_key UNIQUE (username);


--
-- TOC entry 3270 (class 2606 OID 16829)
-- Name: usermedications usermedications_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.usermedications
    ADD CONSTRAINT usermedications_pkey PRIMARY KEY (usermedicationid);


--
-- TOC entry 3260 (class 2606 OID 16766)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (userid);


--
-- TOC entry 3262 (class 2606 OID 16768)
-- Name: users users_userdetailsid_key; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_userdetailsid_key UNIQUE (userdetailsid);


--
-- TOC entry 3279 (class 1259 OID 16911)
-- Name: schedule_unique; Type: INDEX; Schema: public; Owner: docker
--

CREATE UNIQUE INDEX schedule_unique ON public.medicationschedule USING btree (usermedicationid, dayofweek, timeofday, dosesperintake);


--
-- TOC entry 3282 (class 2606 OID 16879)
-- Name: users fk_userdetails; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT fk_userdetails FOREIGN KEY (userdetailsid) REFERENCES public.userdetails(userdetailsid) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;


--
-- TOC entry 3283 (class 2606 OID 16847)
-- Name: users fk_users_roles; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT fk_users_roles FOREIGN KEY (roleid) REFERENCES public.roles(roleid);


--
-- TOC entry 3284 (class 2606 OID 16813)
-- Name: medicationcategories medicationcategories_categoryid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.medicationcategories
    ADD CONSTRAINT medicationcategories_categoryid_fkey FOREIGN KEY (categoryid) REFERENCES public.categories(categoryid);


--
-- TOC entry 3285 (class 2606 OID 16808)
-- Name: medicationcategories medicationcategories_medicationid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.medicationcategories
    ADD CONSTRAINT medicationcategories_medicationid_fkey FOREIGN KEY (medicationid) REFERENCES public.medications(medicationid);


--
-- TOC entry 3289 (class 2606 OID 16940)
-- Name: notifications medicationscheduleid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.notifications
    ADD CONSTRAINT medicationscheduleid_fkey FOREIGN KEY (scheduleid) REFERENCES public.medicationschedule(scheduleid) ON DELETE SET NULL;


--
-- TOC entry 3290 (class 2606 OID 16922)
-- Name: notifications notifications_userid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.notifications
    ADD CONSTRAINT notifications_userid_fkey FOREIGN KEY (userid) REFERENCES public.users(userid);


--
-- TOC entry 3288 (class 2606 OID 16905)
-- Name: medicationschedule usermedications_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.medicationschedule
    ADD CONSTRAINT usermedications_fkey FOREIGN KEY (usermedicationid) REFERENCES public.usermedications(usermedicationid) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;


--
-- TOC entry 3286 (class 2606 OID 16835)
-- Name: usermedications usermedications_medicationid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.usermedications
    ADD CONSTRAINT usermedications_medicationid_fkey FOREIGN KEY (medicationid) REFERENCES public.medications(medicationid);


--
-- TOC entry 3287 (class 2606 OID 16830)
-- Name: usermedications usermedications_userid_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.usermedications
    ADD CONSTRAINT usermedications_userid_fkey FOREIGN KEY (userid) REFERENCES public.users(userid);


-- Completed on 2024-01-21 12:28:39 UTC

--
-- PostgreSQL database dump complete
--

