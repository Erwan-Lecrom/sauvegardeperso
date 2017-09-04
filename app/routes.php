<?php
	
	$w_routes = array(
		//Default Routes
		['GET', '/', 'Default#home', 'home'],
		['GET|POST', '/contact', 'Default#contact', 'contact'],
		['GET', '/a_propos', 'Default#a_propos', 'a_propos'],


		//Users Routes 
		['GET|POST', '/signin', 'Users#signin', 'user_signin'],
		['GET|POST', '/signup', 'Users#signup', 'user_signup'],
		['GET', '/logout', 'Users#logout', 'logout'],
		['GET|POST', '/lost_pwd', 'Users#lost_pwd', 'lost_pwd'],
		['GET|POST', '/reset_pwd/[a:token]', 'Users#reset_pwd', 'reset_pwd'],
		['GET', '/profile', 'Users#profile', 'profile'],

		//Doctors Routes
		['GET', '/medecin/liste', 'Doctors#index', 'doctors_index'],
		['GET', '/medecin/details', 'Doctors#read', 'doctor_details'],
		['GET|POST', '/medecin/create', 'Doctors#create', 'doctor_create'],
		['GET|POST', '/medecin/[i:id]/edit', 'Doctors#update', 'doctor_update'],
		['GET', '/medecin/[i:id]/delete', 'Doctors#delete', 'doctor_delete'],

		//Institutions Routes
		['GET', '/etablissement/liste', 'Institutions#index', 'instutions_index'],
		['GET', '/etablissement/details', 'Institutions#read', 'instution_details'],
		['GET|POST', '/etablissement/create', 'Institutions#create', 'instution_create'],
		['GET|POST', '/etablissement/[i:id]/edit', 'Institutions#update', 'instution_update'],
		['GET', '/etablissement/[i:id]/delete', 'Institutions#delete', 'instution_delete'],

		//Notes Routes
		['GET|POST', '/note/add', 'Notes#create', 'create_note'],
		['GET[POST', '/note/[i:id]/edit', 'Notes#update', 'edit_note'],
		['GET', '/note/[i:id]/delete', 'Notes#delete', 'delete_note'],7
		//
		//


	);