CREATE VIEW `allpostdata` AS
select c.spCountriesname, ci.spCityName, ca.spCateboryname, su.spSubCategoryName, p.spPostingtitle, s.postingdate, p.exipirydate, d.desciption, p.postprice
from posting as p
inner join spSubCategories as su on p.spSubCategories_idSubCategory = su.idspSubCategory
inner join spCities as ci on p.spCities_idspCity = ci.idspCity
inner join spCategory as ca on su.spCategories_idspCategory= ca.idspCategory
inner join spCountries as c on ci.spCountries_idspCountries= c.idspCountries;