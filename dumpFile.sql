--
-- PostgreSQL database dump
--

-- Dumped from database version 15.4
-- Dumped by pg_dump version 15.4

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
-- Name: admins; Type: TABLE; Schema: public; Owner: yogi
--

CREATE TABLE public.admins (
    id uuid NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.admins OWNER TO yogi;

--
-- Name: attendances; Type: TABLE; Schema: public; Owner: yogi
--

CREATE TABLE public.attendances (
    id bigint NOT NULL,
    employee_id uuid NOT NULL,
    check_in timestamp(0) without time zone NOT NULL,
    check_out timestamp(0) without time zone NOT NULL,
    status character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT attendances_status_check CHECK (((status)::text = ANY ((ARRAY['Present'::character varying, 'Late'::character varying, 'Absent'::character varying])::text[])))
);


ALTER TABLE public.attendances OWNER TO yogi;

--
-- Name: attendances_id_seq; Type: SEQUENCE; Schema: public; Owner: yogi
--

CREATE SEQUENCE public.attendances_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.attendances_id_seq OWNER TO yogi;

--
-- Name: attendances_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: yogi
--

ALTER SEQUENCE public.attendances_id_seq OWNED BY public.attendances.id;


--
-- Name: cache; Type: TABLE; Schema: public; Owner: yogi
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache OWNER TO yogi;

--
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: yogi
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache_locks OWNER TO yogi;

--
-- Name: employee_schedules; Type: TABLE; Schema: public; Owner: yogi
--

CREATE TABLE public.employee_schedules (
    id bigint NOT NULL,
    employee_id uuid NOT NULL,
    work_schedule_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.employee_schedules OWNER TO yogi;

--
-- Name: employee_schedules_id_seq; Type: SEQUENCE; Schema: public; Owner: yogi
--

CREATE SEQUENCE public.employee_schedules_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.employee_schedules_id_seq OWNER TO yogi;

--
-- Name: employee_schedules_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: yogi
--

ALTER SEQUENCE public.employee_schedules_id_seq OWNED BY public.employee_schedules.id;


--
-- Name: employees; Type: TABLE; Schema: public; Owner: yogi
--

CREATE TABLE public.employees (
    id uuid NOT NULL,
    name character varying(255) NOT NULL,
    address character varying(255),
    phone_number character varying(255),
    "position" character varying(255) NOT NULL,
    hire_date date NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.employees OWNER TO yogi;

--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: yogi
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO yogi;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: yogi
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.failed_jobs_id_seq OWNER TO yogi;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: yogi
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: job_batches; Type: TABLE; Schema: public; Owner: yogi
--

CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


ALTER TABLE public.job_batches OWNER TO yogi;

--
-- Name: jobs; Type: TABLE; Schema: public; Owner: yogi
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


ALTER TABLE public.jobs OWNER TO yogi;

--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: yogi
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.jobs_id_seq OWNER TO yogi;

--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: yogi
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: yogi
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO yogi;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: yogi
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO yogi;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: yogi
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: yogi
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO yogi;

--
-- Name: salaries; Type: TABLE; Schema: public; Owner: yogi
--

CREATE TABLE public.salaries (
    id bigint NOT NULL,
    employee_id uuid NOT NULL,
    base_salary numeric(10,2) NOT NULL,
    allowance numeric(10,2) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.salaries OWNER TO yogi;

--
-- Name: salaries_id_seq; Type: SEQUENCE; Schema: public; Owner: yogi
--

CREATE SEQUENCE public.salaries_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.salaries_id_seq OWNER TO yogi;

--
-- Name: salaries_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: yogi
--

ALTER SEQUENCE public.salaries_id_seq OWNED BY public.salaries.id;


--
-- Name: sessions; Type: TABLE; Schema: public; Owner: yogi
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id uuid,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO yogi;

--
-- Name: work_schedules; Type: TABLE; Schema: public; Owner: yogi
--

CREATE TABLE public.work_schedules (
    id bigint NOT NULL,
    day_of_week character varying(255) NOT NULL,
    start_time time(0) without time zone NOT NULL,
    end_time time(0) without time zone NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT work_schedules_day_of_week_check CHECK (((day_of_week)::text = ANY ((ARRAY['Monday'::character varying, 'Tuesday'::character varying, 'Wednesday'::character varying, 'Thursday'::character varying, 'Friday'::character varying, 'Saturday'::character varying, 'Sunday'::character varying])::text[])))
);


ALTER TABLE public.work_schedules OWNER TO yogi;

--
-- Name: work_schedules_id_seq; Type: SEQUENCE; Schema: public; Owner: yogi
--

CREATE SEQUENCE public.work_schedules_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.work_schedules_id_seq OWNER TO yogi;

--
-- Name: work_schedules_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: yogi
--

ALTER SEQUENCE public.work_schedules_id_seq OWNED BY public.work_schedules.id;


--
-- Name: attendances id; Type: DEFAULT; Schema: public; Owner: yogi
--

ALTER TABLE ONLY public.attendances ALTER COLUMN id SET DEFAULT nextval('public.attendances_id_seq'::regclass);


--
-- Name: employee_schedules id; Type: DEFAULT; Schema: public; Owner: yogi
--

ALTER TABLE ONLY public.employee_schedules ALTER COLUMN id SET DEFAULT nextval('public.employee_schedules_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: yogi
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: yogi
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: yogi
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: salaries id; Type: DEFAULT; Schema: public; Owner: yogi
--

ALTER TABLE ONLY public.salaries ALTER COLUMN id SET DEFAULT nextval('public.salaries_id_seq'::regclass);


--
-- Name: work_schedules id; Type: DEFAULT; Schema: public; Owner: yogi
--

ALTER TABLE ONLY public.work_schedules ALTER COLUMN id SET DEFAULT nextval('public.work_schedules_id_seq'::regclass);


--
-- Data for Name: admins; Type: TABLE DATA; Schema: public; Owner: yogi
--

COPY public.admins (id, name, email, password, remember_token, created_at, updated_at) FROM stdin;
d80015d2-1bbc-4f6b-b0d1-29973f0fc3d5	Super Admin	admin@example.com	$2y$12$96aaBiRdfSxmE8R6nkDG2ebfzhJ.E6Wp5h.QKw4CTqKKsjk7i4XeW	\N	2024-08-10 14:39:14	2024-08-10 14:39:14
\.


--
-- Data for Name: attendances; Type: TABLE DATA; Schema: public; Owner: yogi
--

COPY public.attendances (id, employee_id, check_in, check_out, status, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: yogi
--

COPY public.cache (key, value, expiration) FROM stdin;
admin@example.net|127.0.0.1:timer	i:1723306194;	1723306194
admin@example.net|127.0.0.1	i:1;	1723306194
\.


--
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: yogi
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- Data for Name: employee_schedules; Type: TABLE DATA; Schema: public; Owner: yogi
--

COPY public.employee_schedules (id, employee_id, work_schedule_id, created_at, updated_at) FROM stdin;
1	90c08488-dd0e-4cdf-9d0c-d3ac17ff62ad	3	2024-08-10 16:41:13	2024-08-10 16:41:13
2	90c08488-dd0e-4cdf-9d0c-d3ac17ff62ad	4	2024-08-10 16:41:13	2024-08-10 16:41:13
3	90c08488-dd0e-4cdf-9d0c-d3ac17ff62ad	5	2024-08-10 16:41:13	2024-08-10 16:41:13
4	90c08488-dd0e-4cdf-9d0c-d3ac17ff62ad	6	2024-08-10 16:41:13	2024-08-10 16:41:13
5	3c7fc893-e49e-4c8f-94a9-bfc64b3633cb	3	2024-08-10 16:50:47	2024-08-10 16:50:47
6	3c7fc893-e49e-4c8f-94a9-bfc64b3633cb	4	2024-08-10 16:50:47	2024-08-10 16:50:47
7	3c7fc893-e49e-4c8f-94a9-bfc64b3633cb	5	2024-08-10 16:50:47	2024-08-10 16:50:47
8	3c7fc893-e49e-4c8f-94a9-bfc64b3633cb	6	2024-08-10 16:50:47	2024-08-10 16:50:47
9	3c7fc893-e49e-4c8f-94a9-bfc64b3633cb	7	2024-08-10 16:50:47	2024-08-10 16:50:47
10	3c7fc893-e49e-4c8f-94a9-bfc64b3633cb	1	2024-08-10 16:50:47	2024-08-10 16:50:47
11	3c7fc893-e49e-4c8f-94a9-bfc64b3633cb	2	2024-08-10 16:50:47	2024-08-10 16:50:47
\.


--
-- Data for Name: employees; Type: TABLE DATA; Schema: public; Owner: yogi
--

COPY public.employees (id, name, address, phone_number, "position", hire_date, created_at, updated_at) FROM stdin;
06b70221-19df-46ad-b5dd-57844db93852	yogi	adadaf	1234567890	dfghj	2024-08-21	2024-08-10 16:28:01	2024-08-10 16:28:01
90c08488-dd0e-4cdf-9d0c-d3ac17ff62ad	r2345678	t23456789	1234567	wqertyui	2024-08-19	2024-08-10 16:41:13	2024-08-10 16:41:13
3c7fc893-e49e-4c8f-94a9-bfc64b3633cb	yogi	adadaf	1234567890	dfghj	2024-08-21	2024-08-10 16:50:47	2024-08-10 16:50:47
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: yogi
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: yogi
--

COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
\.


--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: yogi
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: yogi
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	0001_01_01_000000_create_users_table	1
2	0001_01_01_000001_create_cache_table	1
3	0001_01_01_000002_create_jobs_table	1
4	2024_08_10_024241_create_admins_table	1
5	2024_08_10_042504_create_employees_table	1
6	2024_08_10_043631_create_salaries_table	1
7	2024_08_10_045058_create_attendances_table	1
8	2024_08_10_051005_create_work_schedules_table	1
9	2024_08_10_053251_create_employee_schedules_table	1
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: yogi
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: salaries; Type: TABLE DATA; Schema: public; Owner: yogi
--

COPY public.salaries (id, employee_id, base_salary, allowance, created_at, updated_at) FROM stdin;
3	06b70221-19df-46ad-b5dd-57844db93852	134.00	123.00	2024-08-10 16:28:01	2024-08-10 16:28:01
7	90c08488-dd0e-4cdf-9d0c-d3ac17ff62ad	12348.00	2345.00	2024-08-10 16:41:13	2024-08-10 16:41:13
8	3c7fc893-e49e-4c8f-94a9-bfc64b3633cb	134.00	123.00	2024-08-10 16:50:47	2024-08-10 16:50:47
\.


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: yogi
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
tEppOjNAQNo67SQkT8kZHr6Q5ntTcssyzLxjqESf	d80015d2-1bbc-4f6b-b0d1-29973f0fc3d5	127.0.0.1	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36	YTo0OntzOjY6Il90b2tlbiI7czo0MDoid2VmcDhEUWdFOG11MTlSUW96NmdMODlscXR0dlNlanRCb2NQQU03ZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zY2hlZHVsZSI7fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO3M6MzY6ImQ4MDAxNWQyLTFiYmMtNGY2Yi1iMGQxLTI5OTczZjBmYzNkNSI7fQ==	1723305233
8us9pPjeTA13WiElnscBYA18Z7J4lX0JV2JTe6Pn	\N	127.0.0.1	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36	YTozOntzOjY6Il90b2tlbiI7czo0MDoibDl6RzVMUUxlbmwyZnVlbWdIVmFLNlR4SEpJRUFiZEF2dUNZSFJYaCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fX0=	1723308914
\.


--
-- Data for Name: work_schedules; Type: TABLE DATA; Schema: public; Owner: yogi
--

COPY public.work_schedules (id, day_of_week, start_time, end_time, created_at, updated_at) FROM stdin;
3	Wednesday	09:00:00	17:00:00	2024-08-10 14:39:14	2024-08-10 14:39:14
4	Thursday	09:00:00	17:00:00	2024-08-10 14:39:14	2024-08-10 14:39:14
5	Friday	09:00:00	17:00:00	2024-08-10 14:39:14	2024-08-10 14:39:14
6	Saturday	09:00:00	17:00:00	2024-08-10 14:39:14	2024-08-10 14:39:14
7	Sunday	09:00:00	17:00:00	2024-08-10 14:39:14	2024-08-10 14:39:14
1	Monday	11:00:00	18:00:00	2024-08-10 14:39:14	2024-08-10 15:46:26
2	Tuesday	09:04:00	17:01:00	2024-08-10 14:39:14	2024-08-10 15:47:51
\.


--
-- Name: attendances_id_seq; Type: SEQUENCE SET; Schema: public; Owner: yogi
--

SELECT pg_catalog.setval('public.attendances_id_seq', 1, false);


--
-- Name: employee_schedules_id_seq; Type: SEQUENCE SET; Schema: public; Owner: yogi
--

SELECT pg_catalog.setval('public.employee_schedules_id_seq', 11, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: yogi
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: yogi
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: yogi
--

SELECT pg_catalog.setval('public.migrations_id_seq', 9, true);


--
-- Name: salaries_id_seq; Type: SEQUENCE SET; Schema: public; Owner: yogi
--

SELECT pg_catalog.setval('public.salaries_id_seq', 8, true);


--
-- Name: work_schedules_id_seq; Type: SEQUENCE SET; Schema: public; Owner: yogi
--

SELECT pg_catalog.setval('public.work_schedules_id_seq', 7, true);


--
-- Name: admins admins_pkey; Type: CONSTRAINT; Schema: public; Owner: yogi
--

ALTER TABLE ONLY public.admins
    ADD CONSTRAINT admins_pkey PRIMARY KEY (id);


--
-- Name: attendances attendances_pkey; Type: CONSTRAINT; Schema: public; Owner: yogi
--

ALTER TABLE ONLY public.attendances
    ADD CONSTRAINT attendances_pkey PRIMARY KEY (id);


--
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: yogi
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: yogi
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- Name: employee_schedules employee_schedules_pkey; Type: CONSTRAINT; Schema: public; Owner: yogi
--

ALTER TABLE ONLY public.employee_schedules
    ADD CONSTRAINT employee_schedules_pkey PRIMARY KEY (id);


--
-- Name: employees employees_pkey; Type: CONSTRAINT; Schema: public; Owner: yogi
--

ALTER TABLE ONLY public.employees
    ADD CONSTRAINT employees_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: yogi
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: yogi
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: yogi
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: yogi
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: yogi
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: yogi
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: salaries salaries_pkey; Type: CONSTRAINT; Schema: public; Owner: yogi
--

ALTER TABLE ONLY public.salaries
    ADD CONSTRAINT salaries_pkey PRIMARY KEY (id);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: yogi
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: work_schedules work_schedules_pkey; Type: CONSTRAINT; Schema: public; Owner: yogi
--

ALTER TABLE ONLY public.work_schedules
    ADD CONSTRAINT work_schedules_pkey PRIMARY KEY (id);


--
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: yogi
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: yogi
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: yogi
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- Name: attendances attendances_employee_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: yogi
--

ALTER TABLE ONLY public.attendances
    ADD CONSTRAINT attendances_employee_id_foreign FOREIGN KEY (employee_id) REFERENCES public.employees(id);


--
-- Name: employee_schedules employee_schedules_employee_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: yogi
--

ALTER TABLE ONLY public.employee_schedules
    ADD CONSTRAINT employee_schedules_employee_id_foreign FOREIGN KEY (employee_id) REFERENCES public.employees(id);


--
-- Name: employee_schedules employee_schedules_work_schedule_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: yogi
--

ALTER TABLE ONLY public.employee_schedules
    ADD CONSTRAINT employee_schedules_work_schedule_id_foreign FOREIGN KEY (work_schedule_id) REFERENCES public.work_schedules(id);


--
-- Name: salaries salaries_employee_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: yogi
--

ALTER TABLE ONLY public.salaries
    ADD CONSTRAINT salaries_employee_id_foreign FOREIGN KEY (employee_id) REFERENCES public.employees(id);


--
-- PostgreSQL database dump complete
--

