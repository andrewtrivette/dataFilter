# dataFilter
This class allows data filters to be built as callbacks, and then "stacked" onto each other to create filtered data sets that can be recreated from a simple list of filters. The list can be a simple array, or a json string for easy storage.
The filtered data set can also be negated, allowing you to get the remainder of the original set, excluding the results returned by the filter.
