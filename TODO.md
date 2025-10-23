# TODO: Implement Materials Management System

## Step 1: Fix Controller Class Name
- Change class name from "Dashboard" to "Materials" in app/Controllers/Materials.php

## Step 2: Add Upload Method
- Add upload($course_id) method to Materials controller
- Handle POST request, load upload/validation libraries
- Configure upload (path: writable/uploads, allowed types: pdf,ppt,doc, max size)
- Upload file, save to DB via model, set flash messages, redirect

## Step 3: Add Delete Method
- Add delete($material_id) method to Materials controller
- Check if user is teacher of the course
- Delete file from server, delete DB record, redirect with message

## Step 4: Add Download Method
- Add download($material_id) method to Materials controller
- Check if user is enrolled in the course
- Retrieve file path, use CodeIgniter's download helper to force download

## Step 5: Run Migration
- Execute: php spark migrate

## Step 6: Update Dashboard View (if needed)
- Check app/Views/auth/dashboard.php to ensure materials are displayed with download links

## Step 7: Test Application
- Run app, test upload as admin, download as student

## Step 8: Push to GitHub
- Add, commit, push changes
