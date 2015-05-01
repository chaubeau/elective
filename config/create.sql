CREATE TABLE `student` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `stuid` int(11) NOT NULL COMMENT '学号',
  `stupwd` varchar(128) NOT NULL COMMENT '学生密码',
  `stuname` varchar(64) NOT NULL COMMENT '学生姓名',
  `stuDepart` int(11) NOT NULL COMMENT '学生系院号',
  `stuGrade` int(11) NOT NULL COMMENT '学生年级',
  `stuClass` int(11) NOT NULL COMMENT '学生班级',
  PRIMARY KEY (`id`),
  UNIQUE KEY `stuid` (`stuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='学生相关信息表';

CREATE TABLE `teacher` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `teaid` int(11) NOT NULL COMMENT '教师号',
  `teapwd` varchar(128) NOT NULL COMMENT '教师密码',
  `teaname` varchar(64) NOT NULL COMMENT '教师姓名',
  `teadepart` int(11) NOT NULL COMMENT '教师系院号',
  PRIMARY KEY (`id`),
  UNIQUE KEY `teaid` (`teaid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='教师相关信息表';

CREATE TABLE `admin` (
 `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '自增主键',
 `adminname` varchar(64) NOT NULL COMMENT '管理员姓名',
 `adminpwd` varchar(128) NOT NULL COMMENT '管理员密码',
 PRIMARY KEY (`id`),
 UNIQUE KEY `adminname` (`adminname`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='管理员相关信息表';


CREATE TABLE `cource` (
 `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '自增主键',
 `courseid` varchar(64) NOT NULL COMMENT '课程ID',
 `teaid` varchar(64) NOT NULL COMMENT '教师ID',
 `coursename` varchar(64) NOT NULL COMMENT '课程名称',
 `coursetime` varchar(64) NOT NULL COMMENT '上课时间',
 `courseaddress` varchar(64) NOT NULL COMMENT '上课地点',
 `courseinfo` text NOT NULL COMMENT '课程简介',
 PRIMARY KEY (`id`),
 UNIQUE KEY `CourseTea` (`courseid`,`teaid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='课程信息表';


CREATE TABLE `elect` (
 `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '自增主键',
 `stuid` varchar(64) NOT NULL COMMENT '学号',
 `courseid` varchar(64) NOT NULL COMMENT '课程ID',
 `teaid` varchar(128) NOT NULL COMMENT '教师ID',
 `score` int(10) NOT NULL COMMENT '成绩',
 PRIMARY KEY (`id`),
 UNIQUE KEY `sct` (`stuid`,`courseid`,`teaid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='选课表';

CREATE TABLE `depart` (
 `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '自增主键',
 `departid` int(10) NOT NULL COMMENT '院系编号',
 `departname` varchar(128) NOT NULL COMMENT '院系名称',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='院系名称';

insert into depart(`departid`,`departname`) values(10000,'计算机与信息技术学院');
insert into depart(`departid`,`departname`) values(10001,'电子信息工程学院');
insert into depart(`departid`,`departname`) values(10002,'经济管理学院');
insert into depart(`departid`,`departname`) values(10003,'理学院');
