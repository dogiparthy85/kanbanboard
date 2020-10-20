# kanban board
Kanban board in a web application for the development team to manage their development tasks. The kanban board consists of 4 main columns, Backlog, To Do, Ongoing and Done.

This application is built using CodeIgniter Framework. PHP 7.x is preferred. (version 7.4 is advised.)

Disclaimer: This application is not a complete application and may not be suitable for live environment as it is. 
Only one single user is added from backend with user id and password as admin. 
User Management module yet to be added.

Application is provided with the flexibility of adding multiple stages in Kanban board.

Included a wizard to check the pre-requisite php libraries, folder permissions etc.
Wizard will also ask you to provide initial database details, host, users and password.

Once setup all pre-requisites, permission and database, you are able to login with the default admin account. 

Following critieria's are followed in maintainting the Kanban board.

User Stories for Kanban Board Web Application

Story	Acceptance Criteria	Required
1. As a user, I am able to log into the application.	User is able to input his username and password into the input field on the login page.

User is able to be directed into the kanban board page upon successful login when clicking the submit button.

User is able to see error message upon unsuccessful login when clicking the submit button.	Yes

2. As a user, I am able to create a new task and the new task will be shown in the backlog	Given the user is logged in successfully, when the user inputs into 'new task name' field and click create. Then the user should see the task created in the backlog column	Yes

3. As a user, I am able to remove a task from any of the kanban board column	Given the user clicks on any task in one of the four column, the task name will be shown in a read-only input field.

Given the task name is shown in a read-only input field and the user clicks on delete button, then the user should see the task is removed from the column.	Yes

4. As a user, I am able to move a task forward to the next column in the kanban board.	Given the user clicks on any task in one of the four column, the task name will be shown in a read-only input field.

Given the task name is shown in a read-only input field and the user clicks on a 'Move forward' button, then the task will be moved to the next column.

Given the user clicks on a task in the Done (last) column, then the move forward button will be disabled.	Yes

5. As a user, I am able to move a task backwards to the previous column in the kanban board.	Given the user clicks on any task in one of the four column, the task name will be shown in a read-only input field.

Given the task name is shown in a read-only input field and the user clicks on a 'Move backwards' button, then the task will be moved to the previous column.

Given the user clicks on a task in the Backlog (first) column, then the 'Move backwards' button will be disabled.	Yes

Add on to this .....

User Management
Access Control
Reports
Dashboard (Role Based) with multiple dashlets showing tabular reports, graphical reports showing important metrics
