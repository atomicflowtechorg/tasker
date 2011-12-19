EXPLAIN SELECT DISTINCT pkListId FROM tblList
LEFT JOIN InUseLists ON
tblList.pkListId LIKE InUseLists.fkListId
WHERE InUseLists.fkListId is null
