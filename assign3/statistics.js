function findN(arrayInput){
	return arrayInput.length;
}

function findSum(arrayInput){  // Summation
	var sum = 0;
	for (var i = 0; i < arrayInput.length; i++){
			sum += parseInt(arrayInput[i], 10);
	}
	return sum;
}

function findMean(arrayInput){ // Find Mean
	var mean = 0;
	mean = findSum(arrayInput)/ arrayInput.length;
	return mean;
}

function findMedian(arrayInput){ // Find Median
     
	arrayInput.sort;
        
	//find the middle index
	if((findN(arrayInput)%2) == 0) {
        var upperMiddle = Math.floor(arrayInput.length / 2); 
        //find upper middle minus 1
        if(upperMiddle > 1) {
            var lowerMiddle = arrayInput[upperMiddle - 1];
            upperMiddle = arrayInput[upperMiddle];
			//divide the values at that index
            var median = ((lowerMiddle + upperMiddle) / 2);
            return median;
        } else
            return arrayInput[upperMiddle];
	} else {
        var median = Math.floor(arrayInput.length/2);
        return arrayInput[median];
	}
}

function findVariance(arrayInput){ // Find Variance
	
	var mean = findMean(arrayInput);
	var temp = 0;
	for(var i = arrayInput.length - 1; i >= 0; i--){
		temp += Math.pow((arrayInput[i] - mean), 2);
	}
	temp /= (arrayInput.length - 1);
	return temp;
}

function findStandardDeviation(arrayInput){ // Find Standard Deviation
	// Square root of variance
	return Math.sqrt(findVariance(arrayInput));
}

function findMode(arrayInput){
	var counts = {};
	var modes = [];
	var max = 0;
	
	for (var i = 0; i < arrayInput.length; i++){
		if (!(arrayInput[i] in counts))
			counts[arrayInput[i]] = 0;
		counts[arrayInput[i]]++;
		if(counts[arrayInput[i]] == max)
			modes.push(arrayInput[i]);
		else if (counts[arrayInput[i]] > max){
			max = counts[arrayInput[i]];
			modes = [arrayInput[i]];
		}
	}
	
	var modeFinal = [];
	for (var i = 0; i < modes.length; i++){
		modeFinal.push(modes[i]);
	}
	
	if(modeFinal.length > 1)
		return "Multimodal: " + modes;
	else if (modes.length == 1)
		return "Single mode: " + modes;
	else
		return "No mode";
}