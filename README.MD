# README

**API文档备用地址：[https://www.showdoc.cc/web/#/69006181724124](https://www.showdoc.cc/web/#/69006181724124)**
![二维码](https://www.showdoc.cc/server/index.php?s=/api/common/qrcode&size=3&url=https%3A%2F%2Fwww.showdoc.cc%2Fweb%2F%23%2F69006181724124)

## 使用须知

### 全局错误码

| 错误码  | 错误解释  |
| ------------ | ------------ |
|  0 |  请求成功 |
|  1 | 未登录  |
|  2 | 数据库错误  |
|  3 | 用户类型错误 |
|  9 | 未知错误 |

### 返回数据基本类型

```json
{
  "code": 0,
  "data": null,
  "message": "成功"
}
```
| 名称  | 类型  |说明  |
| ------------ | ------------ |------------ |
|  code |  int |返回码 |
|  data | 多种类型 |部分接口的回传数据  |
|  message |  string |结果说明 |

## 修改记录

    
-  2018年5月

|  日期 | 修改人  | 涉及接口  |  修改内容 |
| ------------ | ------------ | ------------ | ------------ |
| 5月15日  | Mystery0  | ALL  | 第一次提交  |


**备注**
如果有需要，可以进行更改

# 用户管理

## 用户注册

### 简要描述

- 用户注册接口

### 请求URL

- ` https://mystery0.weilylab.com/OnlineStudyWebsite/common/user/register.php `
  
### 请求方式

- POST/GET

### 参数

|参数名|必选|类型|说明|
|:----    |:---|:----- |-----   |
|username |是  |string |用户名   |
|password |是  |string | 密码    |
|userType |是  |string | 用户类型，只能是‘student’或‘teacher    |

### 返回示例

``` 
{
  "code": 0,
  "data": null,
  "message": "成功"
}
```

### 可能返回的返回码

**公共返回码请查看使用须知**

|  code |  message |
| ------------ | ------------ |
|  11 |  用户名为空 |
| 12  | 密码为空  |
| 13 | 用户已存在  |

## 用户登录

### 简要描述

- 用户登录接口

### 请求URL

- ` https://mystery0.weilylab.com/OnlineStudyWebsite/common/user/login.php `
  
### 请求方式

- POST/GET

### 参数

|参数名|必选|类型|说明|
|:----    |:---|:----- |-----   |
|username |是  |string |用户名   |
|password |是  |string | 密码    |

### 返回示例

``` JSON
{
  "code": 0,
  "data": {
    "userType": "student"
  },
  "message": "成功"
}
```

### 返回参数说明

|参数名|类型|说明|
|:-----  |:-----|-----                           |
|userType |string   |用户类型，只有两种：student（学生）和teacher（教师），对应注册时提交的类型  |

### 可能返回的返回码

**公共返回码请查看使用须知**

|  code |  message |
| ------------ | ------------ |
|  11 |  用户名为空 |
| 12  | 密码为空  |
| 13 | 密码错误  |
| 14 | 用户不存在  |

## 注销

### 简要描述

- 用户注销接口

### 请求URL

- ` https://mystery0.weilylab.com/OnlineStudyWebsite/common/user/logout.php `
  
### 请求方式

- POST/GET 

### 参数

- 无


### 返回示例

``` JSON
{
  "code": 0,
  "data": null,
  "message": "成功"
}
```

## 获取个人信息

### 简要描述

- 获取用户的个人信息

### 请求URL 

- ` https://mystery0.weilylab.com/OnlineStudyWebsite/common/user/getInfo.php `
  
### 请求方式

- POST/GET 

### 参数

- 无


### 返回示例

``` json
{
  "code": 0,
  "data": {
    "studentID": "2FB659F75DAB3D0FF790",
    "studentName": "",
    "studentSex": "",
    "studentBirthday": "2018-05-14"
  },
  "message": "成功"
}
```

### 返回参数说明

|参数名|类型|说明|
|:-----  |:-----|-----                           |
|studentID |string   |用户id  |
|studentName |string   |用户名称  |
|studentSex |string   |用户性别  |
|studentBirthday |string   |用户生日  |

### 可能返回的返回码

**公共返回码请查看使用须知**

|  code |  message |
| ------------ | ------------ |
|  11 | 用户不存在  |

## 修改密码

### 简要描述

- 用户修改密码接口

### 请求URL

- ` https://mystery0.weilylab.com/OnlineStudyWebsite/common/user/updatePassword.php `
  
### 请求方式

- POST/GET

### 参数

|参数名|必选|类型|说明|
|:----    |:---|:----- |-----   |
|password |是  |string |旧密码   |
|newPassword |是  |string | 新密码    |

### 返回示例

``` json
{
  "code": 12,
  "data": null,
  "message": "密码错误"
}
```

### 可能返回的返回码

**公共返回码请查看使用须知**

|  code |  message |
| ------------ | ------------ |
|  11 | 用户不存在  |
|  12 | 密码错误  |
|  13 | 新密码不能为空  |

# 通用

## 获取所有课程

### 简要描述

- 列出所有课程

### 请求URL

- ` https://mystery0.weilylab.com/OnlineStudyWebsite/common/common/listCourses.php `
  
### 请求方式

- POST/GET 

### 参数

- 无

### 返回示例

``` json
{
  "code": 0,
  "data": [
    {
      "courseID": "55DADE343DCA2438578D",
      "courseName": "计算机设计大赛",
      "courseIntroduce": "这里是简介",
      "courseTime": "2018-05-15",
      "teacherID": "EACB34271EA5B8048558",
      "teacherName": "康有为"
    },
    {
      "courseID": "BEC4F069ECC19D120983",
      "courseName": "软件工程导论",
      "courseIntroduce": "这里是简介",
      "courseTime": "2018-05-15",
      "teacherID": "EACB34271EA5B8048558",
      "teacherName": "康有为"
    }
  ],
  "message": "成功"
}
```

### 返回参数说明

|参数名|类型|说明|
|:-----  |:-----|-----                           |
|courseID |string   |课程id  |
|courseName |string   |课程名称  |
|courseIntroduce |string|课程简介  |
|courseTime |date   |上课时间  |
|teacherID |string   |创建教师的id  |
|teacherName |string   |任课教师姓名（创建者）  |

## 搜索课程

### 简要描述 

- 搜索课程

### 请求URL
- ` https://mystery0.weilylab.com/OnlineStudyWebsite/common/common/searchCourses.php `
  
### 请求方式
- POST/GET 

### 参数

|参数名|必选|类型|说明|
|:----    |:---|:----- |-----   |
|keyword |是  |string |关键词   |

### 返回示例

``` json
{
  "code": 0,
  "data": [
    {
      "courseID": "BEC4F069ECC19D120983",
      "courseName": "软件工程导论",
      "courseIntroduce": "这里是简介",
      "courseTime": "2018-05-15",
      "teacherID": "EACB34271EA5B8048558",
      "teacherName": "康有为"
    }
  ],
  "message": "成功"
}
```

### 返回参数说明 

|参数名|类型|说明|
|:-----  |:-----|-----                           |
|courseID |string   |课程id  |
|courseName |string   |课程名称  |
|courseIntroduce |string|课程简介  |
|courseTime |date   |上课时间  |
|teacherID |string   |创建教师的id  |
|teacherName |string   |任课教师姓名（创建者）  |

### 可能返回的返回码

**公共返回码请查看使用须知**

|  code |  message |
| ------------ | ------------ |
|  11 | 关键词为空  |

## 获取指定课程的资源信息

### 简要描述

- 获取指定课程的资源信息

### 请求URL
- ` https://mystery0.weilylab.com/OnlineStudyWebsite/common/common/listCourseResources.php `
  
### 请求方式
- POST/GET 

### 参数

|参数名|必选|类型|说明|
|:----    |:---|:----- |-----   |
|courseID |是  |string |课程id   |

### 返回示例

``` json
{
  "code": 0,
  "data": [
    {
      "resourceID": "E01F4F22C67C1C7FD024",
      "resourceName": "测试资源",
      "resourcePath": "https://mystery0.weilylab.com/OnlineStudyWebsite/upload/55DADE343DCA2438578D/xyz.paphonb.pixelnavbar-1.3.1c-21-119667.apk",
      "courseID": "55DADE343DCA2438578D"
    }
  ],
  "message": "成功"
}
```

### 返回参数说明

|参数名|类型|说明|
|:-----  |:-----|-----                           |
|resourceID |string   |资源id  |
|resourceName |string   |资源名称  |
|resourcePath |string   |资源地址  |
|courseID |string   |对应的课程id  |

### 可能返回的返回码

**公共返回码请查看使用须知**

|  code |  message |
| ------------ | ------------ |
|  11 | 课程id为空  |
|  12 | 课程不存在  |

# 学生

## 更新个人信息

### 简要描述

- 更新个人信息

### 请求URL
- ` https://mystery0.weilylab.com/OnlineStudyWebsite/common/student/updateInfo.php `
  
### 请求方式
- POST/GET 

### 参数

|参数名|必选|类型|说明|
|:----    |:---|:----- |-----   |
|studentName |否  |string |教师姓名   |
|studentSex |否  |string | 教师性别    |
|studentBirthday     |否  |date | 教师生日    |

**说明：三个参数不能同时为空！**

### 返回示例

``` json
{
  "code": 0,
  "data": null,
  "message": "成功"
}
```

### 可能返回的返回码

**公共返回码请查看使用须知**

|  code |  message |
| ------------ | ------------ |
|  11 | 用户不存在  |
|  12 | 课程id不能为空  |
|  13 | 课程名不能为空  |
|  14 | 课程不存在  |

## 学生选课

### 简要描述

- 学生选课

### 请求URL
- ` https://mystery0.weilylab.com/OnlineStudyWebsite/common/student/chooseCourse.php `
  
### 请求方式

- POST/GET 

### 参数

|参数名|必选|类型|说明|
|:----    |:---|:----- |-----   |
|courseID |是  |string |用户id   |

### 返回示例

``` json
{
  "code": 0,
  "data": null,
  "message": "成功"
}
```

### 可能返回的返回码

**公共返回码请查看使用须知**

|  code |  message |
| ------------ | ------------ |
|  11 | 课程不存在  |
|  12 | 课程已经选过了  |

## 列出学生加入的课程

### 简要描述

- 列出学生加入的课程

### 请求URL 

- ` https://mystery0.weilylab.com/OnlineStudyWebsite/common/student/listMyCourses.php `
  
### 请求方式

- POST/GET 

### 参数

- 无

### 返回示例

``` 
{
  "code": 0,
  "data": [
    {
      "courseID": "BEC4F069ECC19D120983",
      "courseName": "计算机设计大赛",
      "courseIntroduce": "这里是简介",
      "courseTime": "2018-05-15",
      "teacherID": "EACB34271EA5B8048558",
      "teacherName": "康有为"
    }
  ],
  "message": "成功"
}
```

### 返回参数说明

|参数名|类型|说明|
|:-----  |:-----|-----                           |
|courseID |string   |课程id  |
|courseName |string   |课程名称  |
|courseIntroduce |string|课程简介  |
|courseTime |date   |上课时间  |
|teacherID |string   |创建教师的id  |
|teacherName |string   |任课教师姓名（创建者）  |

## 学生退课

### 简要描述

- 学生退课

### 请求URL

- ` https://mystery0.weilylab.com/OnlineStudyWebsite/common/student/deleteCourse.php `
  
### 请求方式

- POST/GET 

### 参数

|参数名|必选|类型|说明|
|:----    |:---|:----- |-----   |
|courseID |是  |string |用户名   |

### 返回示例

``` json
{
  "code": 0,
  "data": null,
  "message": "成功"
}
```

### 可能返回的返回码

**公共返回码请查看使用须知**

|  code |  message |
| ------------ | ------------ |
|  11 | 课程不存在  |
|  12 | 该门课程未选择  |
|  12 | 课程id不能为空  |

## 查看选课成绩

### 简要描述

- 查看选课成绩

### 请求URL

- ` https://mystery0.weilylab.com/OnlineStudyWebsite/common/student/showCourseGrade.php `
  
### 请求方式

- POST/GET 

### 参数

- 无

### 返回示例

``` 
{
  "code": 0,
  "data": [
    {
      "courseID": "965672BE7BBDE454F816",
      "courseName": "计算机大赛",
      "testName": "",
      "testScore": "0"
    }
  ],
  "message": "成功"
}
```

### 返回参数说明

|参数名|类型|说明|
|:-----  |:-----|-----                           |
|courseID |string   |课程id  |
|courseName |string   |课程名称  |
|testName |string   |考试名称  |
|testScore |float   |考试成绩  |

# 教师

## 更新个人信息

### 简要描述

- 更新个人信息

### 请求URL

- ` https://mystery0.weilylab.com/OnlineStudyWebsite/common/teacher/updateInfo.php `
  
### 请求方式

- POST/GET 

### 参数

|参数名|必选|类型|说明|
|:----    |:---|:----- |-----   |
|teacherName |否  |string |教师姓名   |
|teacherSex |否  |string | 教师性别    |
|teacherBirthday     |否  |date | 教师生日    |

**说明：三个参数不能同时为空！**

### 返回示例**

``` json
{
  "code": 0,
  "data": null,
  "message": "成功"
}
```

### 可能返回的返回码

**公共返回码请查看使用须知**

|  code |  message |
| ------------ | ------------ |
|  11 | 用户不存在  |
|  12 | 课程id不能为空  |
|  13 | 课程名不能为空  |
|  14 | 课程不存在  |

## 新增课程

### 简要描述

- 新增课程

### 请求URL

- ` https://mystery0.weilylab.com/OnlineStudyWebsite/common/teacher/newCourse.php `
  
### 请求方式

- POST/GET 

### 参数

|参数名|必选|类型|说明|
|:----    |:---|:----- |-----   |
|courseName |是  |string |课程名称   |
|courseIntroduce |否  |string | 课程简介    |
|courseTime     |否  |datetime | 上课时间    |

### 返回示例

``` json
{
  "code": 0,
  "data": null,
  "message": "成功"
}
```

### 可能返回的返回码

**公共返回码请查看使用须知**

|  code |  message |
| ------------ | ------------ |
|  11 | 课程名为空  |
|  12 | 教师不存在  |
|  13 | 请先完善教师信息  |

## 列出教师创建的课程

### 简要描述

- 列出教师创建的课程

### 请求URL

- ` https://mystery0.weilylab.com/OnlineStudyWebsite/common/teacher/listMyCourses.php `
  
### 请求方式

- POST/GET 

### 参数

- 无

### 返回示例

``` 
{
  "code": 0,
  "data": [
    {
      "courseID": "BEC4F069ECC19D120983",
      "courseName": "计算机设计大赛",
      "courseIntroduce": "这里是简介",
      "courseTime": "2018-05-15",
      "teacherID": "EACB34271EA5B8048558",
      "teacherName": "康有为"
    }
  ],
  "message": "成功"
}
```

### 返回参数说明

|参数名|类型|说明|
|:-----  |:-----|-----                           |
|courseID |string   |课程id  |
|courseName |string   |课程名称  |
|courseIntroduce |string|课程简介  |
|courseTime |date   |上课时间  |
|teacherID |string   |创建教师的id  |
|teacherName |string   |任课教师姓名（创建者）  |

## 更新课程信息

### 简要描述

- 更新课程信息

### 请求URL

- ` https://mystery0.weilylab.com/OnlineStudyWebsite/common/teacher/updateCourse.php `
  
### 请求方式

- POST/GET 

### 参数

|参数名|必选|类型|说明|
|:----    |:---|:----- |-----   |
|courseID |是  |string |课程id   |
|courseName |是  |string | 课程名称    |
|courseIntroduce     |否  |string | 课程简介    |
|courseTime     |否  |datetime | 上课时间    |

### 返回示例

``` json
{
  "code": 0,
  "data": null,
  "message": "成功"
}
```

### 可能返回的返回码

**公共返回码请查看使用须知**

|  code |  message |
| ------------ | ------------ |
|  11 | 用户不存在  |
|  12 | 课程id不能为空  |
|  13 | 课程名不能为空  |
|  14 | 课程不存在  |

## 删除课程

### 简要描述

- 删除课程

### 请求URL

- ` https://mystery0.weilylab.com/OnlineStudyWebsite/common/teacher/deleteCourse.php `
  
### 请求方式

- POST/GET 

### 参数

|参数名|必选|类型|说明|
|:----    |:---|:----- |-----   |
|courseID |是  |string |用户名   |

### 返回示例

``` json
{
  "code": 0,
  "data": null,
  "message": "成功"
}
```

### 可能返回的返回码

**公共返回码请查看使用须知**

|  code |  message |
| ------------ | ------------ |
|  11 | 课程不存在  |
|  12 | 该门课程未选择  |
|  13 | 课程id不能为空  |

## 上传课程资源

### 简要描述

- 上传课程资源

### 请求URL

- ` https://mystery0.weilylab.com/OnlineStudyWebsite/common/teacher/newCourseResource.php `
  
### 请求方式

- POST 

### 参数

|参数名|必选|类型|说明|
|:----    |:---|:----- |-----   |
|resourceName |是  |string |资源的名称   |
|courseID |是  |string | 对应的课程id    |
|file     |是  |File | 上传的文件    |

**上传的文件只能是一个，最大只能是10M**

### 返回示例

``` json
{
  "code": 0,
  "data": null,
  "message": "成功"
}
```

### 可能返回的返回码

**公共返回码请查看使用须知**

|  code |  message |
| ------------ | ------------ |
|  11 | 资源名为空  |
|  12 | 课程不存在  |
|  13 | 课程id为空  |
|  14 | 文件为空  |
|  15 | 文件过大  |
|  16 | 文件上传失败  |

## 删除课程资源

### 简要描述

- 删除课程资源

### 请求URL

- ` https://mystery0.weilylab.com/OnlineStudyWebsite/common/teacher/deleteCourseResource.php `
  
### 请求方式

- POST/GET 

### 参数

|参数名|必选|类型|说明|
|:----    |:---|:----- |-----   |
|resourceID |是  |string |资源id   |

### 返回示例

``` json
{
  "code": 0,
  "data": null,
  "message": "成功"
}
```

### 可能返回的返回码

**公共返回码请查看使用须知**

|  code |  message |
| ------------ | ------------ |
|  11 | 课程不存在  |
|  12 | 该门课程未选择  |
|  13 | 课程id不能为空  |

## 上传课程成绩

### 简要描述

- 上传课程成绩

### 请求URL

- ` https://mystery0.weilylab.com/OnlineStudyWebsite/common/teacher/updateStudentCourse.php `
  
### 请求方式

- POST/GET 

### 参数

|参数名|必选|类型|说明|
|:----    |:---|:----- |-----   |
|courseID |是  |string |课程id   |
|studentID |否  |string | 学生id    |
|testName     |否  |string | 考试名称    |
|testScore     |否  |float | 考试成绩    |

**考试名称和考试成绩不能同时为空**

### 返回示例

``` json
{
  "code": 0,
  "data": null,
  "message": "成功"
}
```

### 可能返回的返回码

**公共返回码请查看使用须知**

|  code |  message |
| ------------ | ------------ |
|  11 | 课程id不能为空  |
|  12 | 课程不存在  |
|  13 | 学生不存在  |