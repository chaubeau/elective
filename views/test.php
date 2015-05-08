
select s.stuid,s.stuname,s.stuGrade,s.stuClass,d.departname from elective.student s join elective.depart d where s.stuDepart=d.departid and stuid in (select stuid from elective.elect where teaid=800002 and courseid=1000080);
