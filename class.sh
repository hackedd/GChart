#!/bin/bash
class=$1
type=$2

echo -e "<?php"
echo -e "\tclass $class extends GChart"
echo -e "\t{"
echo -e "\t\tpublic function __construct(\$width, \$height)"
echo -e "\t\t{"
echo -e "\t\t\tparent::SetType(GChart::TYPE_$type);"
echo -e "\t\t\tparent::SetSize(\$width, \$height);"
echo -e "\t\t}"
echo

grep "public function" class.GChart.php | while read def
do
	name=`echo $def | cut -d\  -f 3 | cut -d\( -f 1`
	
	skip=false
	for n in __construct GetImageUrl Render GetType GetWidth GetHeight SetSize \
		GetDatasetCount GetDataset AddDataset RemoveDataset GetEncoding \
		SetEncoding GetScale SetScale GetMargin SetMargin GetTextScaling \
		SetTextScaling GetChartColorCount GetChartColor AddChartColor RemoveChartColor
	do
		[[ $name == $n ]] && skip=true
	done
	
	if [ $skip != true ]
	then
		echo -e "\t\t$def"
		echo -e "\t\t{"
		echo -e "\t\t\tthrow new Exception(\"$class does not support $name\");"
		echo -e "\t\t}"
		echo
	fi
done

echo -e "\t}"
echo -e "?>"
