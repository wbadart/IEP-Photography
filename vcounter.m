% vcounter.m
% Reads in text file with list of photo titles, tallies the occurence of
% each title, and ranks them.

% Author:       Will Badart
% Last Edited:  6/9/15

clear;
clc;

%% Import File

filename = 'votes.txt';
delimiter = '';
formatSpec = '%s%[^\n\r]';
fileID = fopen(filename,'r');
dataArray = textscan(fileID, formatSpec, 'Delimiter', delimiter, 'EmptyValue' ,NaN, 'ReturnOnError', false);
fclose(fileID);
voteList = dataArray{:, 1};
clearvars filename delimiter formatSpec fileID dataArray ans;

%% Count Titles

foundList = {0, 0};
j = 1;
found = false;
for i = 1:length(voteList)
    disp(voteList{i, 1});
    iters = size(foundList);
    for k = 1:iters(1)
        if strcmp(char(voteList{i, 1}), char(foundList{k, 1}))
            disp 'duplicate';
            found = true;
            foundList{k, 2} = foundList{k, 2} + 1;
            break
        else
            found = false;
        end
    end
    if ~found
        foundList{j, 1} = voteList{i, 1};
        foundList{j, 2} = 1;
        j = j + 1;
    end
end

%% Rank Images

a = bubbleSortCells(foundList);