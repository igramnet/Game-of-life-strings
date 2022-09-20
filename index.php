<?php

function GameOfLifeStrings(string $str)
{
    // First - Create Array
    $allLines = explode('_', $str);
    $allElements = [];
    foreach ($allLines as $numberLine => $lineWithElement) {
        $lineArray = str_split($lineWithElement);
        foreach ($lineArray as $numberElement => $element) {
            $allElements[$numberLine][$numberElement] = $element;
        }
    }


    //
    $combinations = [
        '0,1',
        '1,1',
        '1,0',
        '1,-1',
        '0,-1',
        '-1,-1',
        '-1,0',
        '-1,1'

    ];
    $allElementsResult = $allElements;
    foreach ($allElements as $keyLine => $lineElements) {

        foreach ($lineElements as $keyElementInLine => $element) {

            $countLiveNeighbours = 0;
            $countDeadNeighbours = 0;
            foreach ($combinations as $combination) {
                $offSet = explode(',', $combination);
                $checkLine = $keyLine + (int)$offSet[0];
                $checkCell = $keyElementInLine + (int)$offSet[1];

                if ($checkLine >= 0 and $checkCell >= 0) {
                    if (isset($allElements[$checkLine][$checkCell]) and $allElements[$checkLine][$checkCell] == '1') {
                        $countLiveNeighbours++;
                    }
                    if (isset($allElements[$checkLine][$checkCell]) and $allElements[$checkLine][$checkCell] == '0') {
                        $countDeadNeighbours++;
                    }
                }
            }


            if ($allElements[$keyLine][$keyElementInLine] == '0' and $countLiveNeighbours === 3) {
                $allElementsResult[$keyLine][$keyElementInLine] = 1;
            } elseif ($allElements[$keyLine][$keyElementInLine] == '1') {
                if ($countLiveNeighbours < 2 or $countLiveNeighbours > 3) {
                    $allElementsResult[$keyLine][$keyElementInLine] = 0;
                }
            }
        }

    }

    $result = [];
    foreach ($allElementsResult as $key => $line) {
        $result [] = implode('', $line);
    }
    return implode('_', $result);
}

$value = '000_111_000';
echo GameOfLifeStrings($value);