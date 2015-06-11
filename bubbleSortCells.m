function [ vOut ] = bubbleSortCells( v )
% Sorts list of numbers in ascending order using bubble method.

switched = true;
while switched
    vOrig = v;
    for i = 1:length(v) - 1
        if v{i, 2} > v{i+1, 2}
            [a, b] = v{i, :};
            [c, d] = v{i+1, :};
            
            v{i, 1} = c;
            v{i, 2} = d;
            v{i+1, 1} = a;
            v{i+1, 2} = b;
            
            switched = true;
        end
    end
    
    if isequal(vOrig, v)
        switched = false;
    end
    
end

v = flipud(v);
vOut = v;

end