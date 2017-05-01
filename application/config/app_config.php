<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  $config['pages_cannot_be_deleted'] = "'home'";
  
  $config['records_per_page'] = 10;

  $config['templates'] = array( 
                                '' => '-- Choose Template --',
                                'page' => 'Page',
                                'home' => 'Home',
                              );


  $config['status_opts']  = array(
                                  '' => '-- SELECT STATUS --',
                                  'active' => 'Active', 
                                  'inactive' => 'Inactive',
                                );

  $config['in_menu_opts']  = array(
                                  'no' => 'No',
                                  'yes' => 'Yes', 
                                  );


  $config['gender_opts']  = array(
                                  ''=>'-- SELECT GENDER --',
                                  'male' => 'Male', 
                                  'female'=>'Female',
                                  'others'=>'Others'
                                );

  $config['specialization_opts'] = array(
                                            '' => 'Select Specialization',
                                            'Allergist_Immunologist' =>  'Allergist Immunologist',
                                            'Anesthesiologist' => 'Anesthesiologist',
                                            'Cardiologist' => 'Cardiologist',
                                            'Dermatologist' => 'Dermatologist',
                                            'Gastroenterologist'  =>  'Gastroenterologist',
                                            'Hematologist_Oncologist' =>  'Hematologist Oncologist',
                                            'General_Medcine' =>  'General Medcine',
                                            'Nephrologist' => 'Nephrologist',
                                            'Neurologist' => 'Neurologist',
                                            'Obstetrician' => 'Obstetrician',
                                            'Gynecologist' => 'Gynecologist',
                                            'Ophthalmologist' => 'Ophthalmologist',
                                            'Orthopaedic' =>  'Orthopaedic',
                                            'Otolaryngologist' => 'Otolaryngologist',
                                            'Pathologist' => 'Pathologist',
                                            'Pediatrician' => 'Pediatrician',
                                            'Psychiatrist' => 'Psychiatrist',
                                            'Pulmonary_Medicine' => 'Pulmonary Medicine',
                                            'Rheumatologist' => 'Rheumatologist',
                                            'Urologist' => 'Urologist',
                                            'Dentist' =>  'Dentist',
                                            'others' => 'Others'

                                        );



  $config['appointment_status_opts'] = array(     
                                                  '' => '-- SELECT APPOINTMENT STATUS --',
                                                  'pending' => 'Pending',
                                                  'inprogress' => 'Inprogress',
                                                  'generated' =>'Generated',
                                                  'cancelled' => 'Cancelled'
                                            );

  $config['payment_status_opts'] = array(
                                            ''=> '-- SELECT PAYMENT STATUS --',
                                            'paid' => 'Paid',
                                            'unpaid' => 'Unpaid'
                                        );