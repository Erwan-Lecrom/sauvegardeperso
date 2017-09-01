<?php
	
	$w_routes = array(
		//Default Routes
		['GET', '/', 'Default#home', 'home'],
		['GET|POST', '/contact', 'Default#contact', 'contact'],
		['GET', '/a_propos', 'Default#a_propos', 'a_propos'],


		//User Routes 
		['GET|POST', '/signin', 'User#signin', 'user_signin'],
		['GET|POST', '/signup', 'User#signup', 'user_signup'],
		['GET', '/logout', 'User#logout', 'logout'],
		['GET|POST', '/lost_pwd', 'User#lost_pwd', 'lost_pwd'],
		['GET|POST', '/reset_pwd/[a:token]', 'User#reset_pwd', 'reset_pwd'],
		['GET', '/profile', 'User#profile', 'profile'],

		//Doctors Routes
		['GET', '/medecin/liste', 'Doctors#list', 'doctors_list'],
		['GET', '/medecin/details', 'Doctors#home', 'doctor_details'],
		['GET|POST', '/medecin/create', 'Doctors#home', 'doctor_create'],
		['GET|POST', '/medecin/[i:id]/edit', 'Doctors#home', 'doctor_update'],
		['GET', '/medecin/[i:id]/delete', 'Doctors#home', 'doctor_delete'],

		//Institutions Routes
		['GET', '/etablissement/liste', 'Institution#list', 'instution_list'],
		['GET', '/etablissement/details', 'Institution#details', 'instution_details'],
		['GET|POST', '/etablissement/create', 'Institution#create', 'instution_create'],
		['GET|POST', '/etablissement/[i:id]/edit', 'Institution#update', 'instution_update'],
		['GET', '/etablissement/[i:id]/delete', 'Institution#delete', 'instution_delete'],

		//Notes Routes
		['GET|POST', '/note/add', 'Notes#create', 'create_note'],
		['GET[POST', '/note/[i:id]/edit', 'Notes#Update', 'edit_note'],
		['GET', '/note/[i:id]/delete', 'Notes#delete', 'delete_note'],



	);