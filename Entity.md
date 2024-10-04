# <span style="color:red;">E</span><span style="color:orange;">X</span><span style="color:yellow;">A</span><span style="color:green;">M</span><span style="color:blue;">I</span><span style="color:purple;">F</span><span style="color:teal;">Y</span> project


## <span style="color:blue;">Teacher</span>

- **id**: `integer` (auto-increment)
- **name**: `string`
- **email**: `string`
- **password**: `string`

## <span style="color:green;">Student</span>

- **id**: `integer` (auto-increment)
- **name**: `string`
- **email**: `string`
- **password**: `string`

## <span style="color:orange;">Semester</span>

- **id**: `integer` (auto-increment)
- **name**: `string`
- **academicYear**: `string`

## <span style="color:purple;">Subject</span>

- **id**: `integer` (auto-increment)
- **name**: `string`
- **semester**: `Semester` (ManyToOne)

## <span style="color:red;">Exam</span>

- **id**: `integer` (auto-increment)
- **title**: `string`
- **questions**: `json` (tableau des questions)
- **createdAt**: `datetime`
- **availableFrom**: `datetime`
- **availability**: `integer` (minutes)
- **status**: `integer`
- **subject**: `Subject` (ManyToOne)

## <span style="color:teal;">Question</span>

- **id**: `integer` (auto-increment)
- **questionText**: `string`
- **choices**: `json` (tableau de chaînes de caractères)
- **correctAnswerIndex**: `integer`

## <span style="color:maroon;">Answer</span>

- **id**: `integer` (auto-increment)
- **student**: `Student` (ManyToOne)
- **exam**: `Exam` (ManyToOne)
- **response**: `integer`
- **score**: `integer`