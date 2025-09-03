###################
Dynamic Event Registration & Approval System with Quotas
###################

A clear and compact explanation of how quotas, approval bands, dynamic forms and login work in the delivered CodeIgniter 3 project.

*******************
Login
*******************

This demo uses seeded users with email and password login  to keep the example minimal and focused.
admin login
user: admin@example.com
pass : 123456  

employee login 
user : emp1@example.com
pass : 123456

manager login
user : manager@example.com
pass : 123456

Director login
user : director@example.com
pass : 123456

**************************
After login
**************************

Admin users see an Event link,set up approvals link in the nav.(manage event, add, update , delete)
Manager/Director see an Approver link.(approved, rejected)
Employee/Manager/Director/External see an upcoming event.(uplcoming list event wise , form fill registration)

************
Dynamic forms
************
event_id — links to events.id

label — human label shown on form

field_name — name attribute for the HTML input (unique per event)

field_type — supported: text, email, number, dropdown

field_options — for dropdown only; comma-separated options (e.g. HR,Engineering,Sales)

required — boolean: whether the field is mandatory

*******************
Quota logic
*******************

limit number of participants per event + registrant role (employee/manager/director/external).
If approved_count >= max_participants
status waitlist
else
status pending

************
final approval
************
The system re-checks the quota (counts approved only — or approved+pending as implemented).
band order wise approval or rejected

