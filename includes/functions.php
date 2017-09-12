<?php
	function redirect_to($new_location){
		header("Location: " . $new_location);
		exit;  
	}
	
	function find_all_departments($connection, $faculty_id){
		$query = "SELECT * FROM departement ";
		$query .= "WHERE faculty_id={$faculty_id} ";
		$department_set = mysqli_query($connection, $query );
		return $department_set;
	}
	
	
	function find_all_doctors($connection, $faculty_id){
		$query = "SELECT * FROM doctor ";
		$query .= "WHERE faculty_id={$faculty_id} ";
		$doctor_set = mysqli_query($connection, $query );
		return $doctor_set;
	}
	
	function find_all_students($connection, $faculty_id, $year_id){
		$query = "SELECT * FROM student ";
		$query .= "WHERE faculty_id={$faculty_id} ";
		//$query .= "AND departement_id={$dept_id} ";
		$query .= "AND year={$year_id} ";
		$query .= "ORDER BY student_name ASC ";
		$student_set = mysqli_query($connection, $query );
		if($student_set)
			return $student_set;
		else
			return mysqli_error($connection);
	}
	
	function find_all_years($connection, $faculty_id){
		$query = "SELECT * FROM year ";
		$query .= "WHERE faculty_id={$faculty_id}";	
		$year_set = mysqli_query($connection, $query );
		return $year_set;
	}
	
	function find_all_courses($connection, $faculty_id){
		$query = "SELECT * FROM subject ";
		$query .= "WHERE faculty_id={$faculty_id} ";
		$course_set = mysqli_query($connection, $query );
		return $course_set;
	}
	
	function find_all_sections($connection, $faculty_id){
		$query = "SELECT * FROM section ";
		$query .= "WHERE departement_faculty_id={$faculty_id} ";
		$section_set = mysqli_query($connection, $query );
		return $section_set;
	}
	
	function find_section_name($connection, $section_id){
		$query = "SELECT * FROM section ";
		$query .= "WHERE id={$section_id} ";
		$query .= "LIMIT 1";
		$section_set = mysqli_query($connection, $query );
		$section = mysqli_fetch_assoc($section_set);
		return $section['section_name'];
	}
	
	function find_section_id($connection, $section_name){
		$query = "SELECT * FROM section ";
		$query .= "WHERE section_name={$section_name} ";
		$query .= "LIMIT 1";
		$section_set = mysqli_query($connection, $query );
		$section = mysqli_fetch_assoc($section_set);
		return $section['id'];
	}
	
	
	function find_faculty_by_name($connection, $facultyName){
		$query  = "SELECT * from faculty ";
		$query .= "WHERE faculty_name = '{$facultyName}' ";
		$query .= "LIMIT 1";
		$result = mysqli_query($connection, $query);
		if($faculty = mysqli_fetch_assoc($result)){
			return $faculty;
		}else
			return null;
	}
	
	function find_faculty_by_id($connection, $facultyId){
		$query  = "SELECT * from faculty ";
		$query .= "WHERE id = '{$facultyId}' ";
		$query .= "LIMIT 1";
		$result = mysqli_query($connection, $query);
		if($faculty = mysqli_fetch_assoc($result)){
			return $faculty;
		}else
			return null;
	}
	
	function find_admin_by_username($connection, $user_name){
		//$username = mysqli_real_escape_string($connection, $user_name);
		$query  = "SELECT * from admin ";
		$query .= "WHERE username = '{$user_name}' ";
		$query .= "LIMIT 1";
		$result = mysqli_query($connection, $query);
		if($admin = mysqli_fetch_assoc($result)){
			return $admin;
		}else
			return null;
	}
	
	function attemp_login($connection, $username, $password){
		$admin = find_admin_by_username($connection, $username);
		
		if($admin){
			if($password == $admin['password']){
				return $admin;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	function logout($admin_id){
		unset($admin_id);
		redirect_to('login.php');
	}
	
?>