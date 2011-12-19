EXPLAIN SELECT pkListId
FROM tblList
WHERE pkListId NOT IN
    (
    SELECT fkListId
    FROM tblListTask
    );