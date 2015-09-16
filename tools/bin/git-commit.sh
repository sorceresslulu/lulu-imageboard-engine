#!/bin/bash
clear
cd ${0%/*}
cd ../../
git status

printf "Iteration (0000): "
read iteration
iteration=`printf %04d $iteration`

printf "Feature (0000): "
read feature
feature=`printf %04d $feature`

echo "Type";
echo "  [f] Frontend "
echo "  [b] Backend "
echo "  [a] All "
printf "Choice: "
read featureType;

case $featureType in
"f")
featureType="frontend"
;;
"b")
featureType="backend"
;;
"a")
featureType="all"
;;
*) 
echo "Unknown type"
exit 0
;;
esac

comment=$1
message=`printf "ITERATION-%s / FEATURE-%s / %s / %s" $iteration $feature $featureType $comment`

echo "Commit message: $message"
echo "Commit? (y/n):";

read accept;

case $accept in
"y")
git commit -m "$message"
;;
*)
;;
esac